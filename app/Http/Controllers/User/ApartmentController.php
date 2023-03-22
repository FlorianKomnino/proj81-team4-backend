<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    protected $validationRules = [
        'title' => ['required', 'string', 'min:2', 'max:255'],
        'rooms' => 'int|min:1',
        'beds' => 'int|min:1',
        'bathrooms' => 'int|min:1',
        'square_meters' => 'int|min:4',
        'address' => 'string',
        'services' => 'nullable',
        'image' => 'image|max:2048'
    ];

    protected $validationErrorMessages = [
        'title.required' => 'Il titolo è necessario.',
        'title.unique' => 'Il titolo non può essere uguale ad un altro titolo in archivio.',
        'title.min' => 'Il titolo deve essere lungo almeno 2 caratteri.',
        'title.max' => 'Il titolo non può superare i 255 caratteri.',

        'rooms.integer' => 'Il valore inserito deve essere un numero',
        'rooms.min' => 'Il numero di stanze non deve essere inferiore a uno',

        'beds.integer' => 'Il valore inserito deve essere un numero',
        'beds.min' => 'Il numero di letti non deve essere inferiore a uno',

        'bathrooms.integer' => 'Il valore inserito deve essere un numero',
        'bathrooms.min' => 'Il numero di bagni non deve essere inferiore a uno',

        'square_meters.integer' => 'Il valore inserito deve essere un numero',
        'square_meters.min' => 'Il numero di metri quadri non deve essere inferiore a quattro',

        'address.string' => 'Il valore inserito deve essere una stringa',

        'image.image' => 'Il file inserito deve essere un\'immagine',
        'image.max' => 'Il file inserito non deve superare i 2 Megabyte'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all()->where('user_id',Auth::user()->id);
        return view('user.apartmentIndex', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *@param Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        return view('user.createApartmentForm', ['apartment' => new Apartment(), 'services' => Service::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validations
        $rules = $this->validationRules;
        array_push($rules['title'],Rule::unique('apartments')->where('user_id', Auth::user()->id));
        $errors = $this->validationErrorMessages;
        $data = $request->validate($rules, $errors);

        //tomtom call
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $data['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");
        $jsonData = $response->json();

        $data['user_id'] = Auth::user()->id;
        isset($data['image']) ? $data['image'] = Storage::put('imgs/', $data['image']) : null;

        //wrong address control
        if ($jsonData['results'] != []) {
            $data['latitude'] = $jsonData['results'][0]['position']['lat'];
            $data['longitude'] = $jsonData['results'][0]['position']['lon'];
        } else {
            $newApartment = new Apartment();
            $newApartment->fill($data);
            $newApartment->save();
            $newApartment->services()->sync($data['services'] ?? []);
            return redirect()->route('user.apartments.edit', $newApartment->id)->with('message', 'Attenzione, l\'appartamento è stato creato correttamente ma l\'indirizzo inserito non ha prodotto alcun risultato! Per favore inserisci un indirizzo valido');
        }
        $newApartment = new Apartment();
        $newApartment->fill($data);
        $newApartment->save();
        $newApartment->services()->sync($data['services'] ?? []);
        return redirect()->route('user.apartments.show', $newApartment->id)->with('message', "$newApartment->title has been created")->with('alert-type', 'primary');
    }

    /**
     * Display the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $user = Auth::user();
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $apartment['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");

        $jsonData = $response->json();
        return view('user.showApartment', ['apartment' => $apartment, 'user' => $user, 'jsonData' => $jsonData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        return view('user.editApartmentForm', ['apartment' => $apartment, 'services' => $services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //validations
        $rules = $this->validationRules;
        array_push($rules['title'], 
            Rule::unique('apartments')->where('user_id', Auth::user()->id)->ignore($apartment->id));
        $errors = $this->validationErrorMessages;
        $data = $request->validate($rules, $errors);

        //tomtom call
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $data['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");
        $jsonData = $response->json();
        $data['user_id'] = Auth::user()->id;

        //! gestire eliminazione dell'immagine su modifica isset($data['image']) ? $data['image']=Storage::put('imgs/', $data['image']) : null;

        //wrong address control
        if ($jsonData['results'] != []) {
            $data['latitude'] = $jsonData['results'][0]['position']['lat'];
            $data['longitude'] = $jsonData['results'][0]['position']['lon'];
        } else {
            $apartment->update($data);
            return redirect()->route('user.apartments.edit', $apartment->id)->with('message', 'Attenzione, l\'appartamento è stato creato correttamente ma l\'indirizzo inserito non ha prodotto alcun risultato! Per favore inserisci un indirizzo valido');
        }


        $apartment->services()->sync($data['services'] ?? []);
        $apartment->update($data);
        return redirect()->route('user.apartments.show', $apartment)->with('message', "Successfully updated")->with('alert-type', 'primary');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if (Storage::exists($apartment->image)) {
            Storage::delete($apartment->image);
        } else {
            dd('file does not exist');
        }
        $apartment->delete();
        return redirect()->route('user.apartments.index')->with('message', 'The apartment has been removed correctly')->with('message_class', 'danger');
    }

    public function APICall()
    {
        $response = Http::get('https://api.tomtom.com/search/2/search/roma.json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr');

        $jsonData = $response->json();
        dd($jsonData);
        return view('tomtom.tomtomMap', ['jsonData' => $jsonData]);
    }
}
