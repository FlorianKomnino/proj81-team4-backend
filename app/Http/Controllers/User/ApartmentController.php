<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    protected $validationRules = [
        'title' => ['required', 'string', 'min:2', 'max:255'],
        'rooms' => 'required|int|min:1|max:20',
        'beds' => 'required|int|min:1|max:40',
        'bathrooms' => 'required|int|min:1|max:10',
        'square_meters' => 'required|int|min:4',
        'address' => 'required|string|min:2|max:255',
        'services' => 'required|array|exists:services,id',
        'image' => 'image|max:2048',
        'visible' => 'boolean'
    ];

    protected $validationErrorMessages = [
        'title.required' => 'Il titolo è necessario.',
        'title.string' => 'Il valore inserito deve essere una stringa di lunghezza compresa tra 2 e 255 caratteri inclusi.',
        'title.unique' => 'Il titolo non può essere uguale ad un altro titolo in archivio.',
        'title.min' => 'Il titolo deve essere lungo almeno 2 caratteri.',
        'title.max' => 'Il titolo non può superare i 255 caratteri.',

        'rooms.required' => 'Il numero di stanze è necessario.',
        'rooms.integer' => 'Il valore inserito deve essere un numero compreso tra 1 e 20.',
        'rooms.min' => 'Il numero di stanze non deve essere inferiore a 1.',
        'rooms.max' => 'Il numero di stanze non deve essere superiore a 20.',

        'beds.required' => 'Il numero di letti è necessario.',
        'beds.integer' => 'Il valore inserito deve essere un numero compreso tra 1 e 40.',
        'beds.min' => 'Il numero di letti non deve essere inferiore a 1.',
        'beds.max' => 'Il numero di letti non deve essere superiore a 40.',

        'bathrooms.required' => 'Il numero di bagni è necessario.',
        'bathrooms.integer' => 'Il valore inserito deve essere un numero compreso tra 1 e 10.',
        'bathrooms.min' => 'Il numero di bagni non deve essere inferiore a 1.',
        'bathrooms.max' => 'Il numero di bagni non deve essere superiore a 10.',

        'square_meters.required' => 'Il numero di metri quadri è necessario.',
        'square_meters.integer' => 'Il valore inserito deve essere un numero maggiore o uguale a 4.',
        'square_meters.min' => 'Il numero di metri quadri non deve essere inferiore a 4.',

        'address.required' => 'L\'indirizzo è necessario.',
        'address.string' => 'Il valore inserito deve essere una stringa.',
        'address.min' => 'L\'indirizzo deve essere lungo almeno 2 caratteri.',
        'address.max' => 'L\'indirizzo non può superare i 255 caratteri.',

        'services.required' => 'Seleziona almeno un servizio.',

        'image.image' => 'Il file inserito deve essere un\'immagine.',
        'image.max' => 'Il file inserito non deve superare i 2 Megabyte.'
    ];

    public function serviceFilter(Apartment $apartment)
    {


        // $apartments = Apartment::with('services')->get();

        // $nomediverso = $apartments->reject(function($apartment){
        //     dd($apartment->services);
        //     return $apartment->services->where('id','1');
        // });

        $services = Service::with('apartments')->where('id', '1')->get();
        $filteredApartments = $services->map(function ($service) {
            dd($service->apartments);
            return $service->apartments->where('id', '1');
        });


        $apartments = $services->apartments;
        dd($apartments);
        // $nomediverso = $apartments->reject(function($apartment){
        //     dd($apartment->services);
        //     return $apartment->services->where('id','1');
        // });

        //$nomediverso

        dd($services);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', Auth::user()->id);
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
        array_push($rules['title'], Rule::unique('apartments')->where('user_id', Auth::user()->id));
        $errors = $this->validationErrorMessages;
        $data = $request->validate($rules, $errors);
        $data['slug'] = Str::slug($data['title']);
        $newAddress = $data['address'];
        if (str_contains($newAddress, '/')) {
            $newAddress = str_replace('/', '_', $newAddress);
        }

        //tomtom call
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $newAddress . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");
        $jsonData = $response->json();

        $data['user_id'] = Auth::user()->id;
        isset($data['image']) ? $data['image'] = Storage::put('imgs/', $data['image']) : $data['image'] = asset('logo/home.jpeg');

        //wrong address control
        if ($jsonData['results'] != []) {
            $data['latitude'] = $jsonData['results'][0]['position']['lat'];
            $data['longitude'] = $jsonData['results'][0]['position']['lon'];
        } else {
            $newApartment = new Apartment();
            $newApartment->fill($data);
            $newApartment->save();
            $newApartment->slug = $newApartment->slug . $newApartment->id;
            $newApartment->update();
            $newApartment->services()->sync($data['services']);
            return redirect()->route('user.apartments.edit', $newApartment->slug)->with('message', 'Attenzione, l\'appartamento è stato creato correttamente ma l\'indirizzo inserito non ha prodotto alcun risultato! Per favore inserisci un indirizzo valido');
        }
        $newApartment = new Apartment();
        $newApartment->fill($data);
        $newApartment->save();
        $newApartment->slug = $newApartment->slug . $newApartment->id;
        $newApartment->update();
        $newApartment->services()->sync($data['services']);
        return redirect()->route('user.apartments.show', $newApartment->slug)->with('message', "$newApartment->title has been created")->with('alert-type', 'primary');
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
        $messages = Message::where('apartment_id', $apartment->id)->orderBy('email', 'asc')->get();
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $apartment['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");

        $jsonData = $response->json();
        return view('user.showApartment', ['apartment' => $apartment, 'user' => $user, 'jsonData' => $jsonData, 'messages' => $messages]);
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
        array_push(
            $rules['title'],
            Rule::unique('apartments')->where('user_id', Auth::user()->id)->ignore($apartment->id)
        );
        $errors = $this->validationErrorMessages;
        $data = $request->validate($rules, $errors);
        $data['slug'] = Str::slug($data['title'] . $apartment->id);

        //tomtom call
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $data['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");
        $jsonData = $response->json();
        $data['user_id'] = Auth::user()->id;

        if (isset($data['image'])) {
            Storage::delete($apartment->image);
            $data['image'] = Storage::put('imgs/', $data['image']);
        } else {
            $data['image'] = $apartment->image;
        }
        //wrong address control
        if ($jsonData['results'] != []) {
            $data['latitude'] = $jsonData['results'][0]['position']['lat'];
            $data['longitude'] = $jsonData['results'][0]['position']['lon'];
        } else {
            $apartment->update($data);
            $apartment->services()->sync($data['services']);
            return redirect()->route('user.apartments.edit', $apartment->slug)->with('message', 'Attenzione, l\'appartamento è stato creato correttamente ma l\'indirizzo inserito non ha prodotto alcun risultato! Per favore inserisci un indirizzo valido');
        }


        $apartment->update($data);
        $apartment->services()->sync($data['services']);
        return redirect()->route('user.apartments.show', $apartment->slug)->with('message', "Successfully updated")->with('alert-type', 'primary');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment, Message $message)
    {
        // dd(isset($apartment->image));
        if (isset($apartment->image)) {
            Storage::delete($apartment->image);
        } else {
            $apartment->delete();
            return redirect()->route('user.apartments.index');
        }
        // remove comment if you want to delete messages with apartment's soft delete
        // $message = Message::where('apartment_id', $apartment->id)->delete();
        $apartment->delete();
        return redirect()->route('user.apartments.index');
    }

    public function APICall()
    {
        $response = Http::get('https://api.tomtom.com/search/2/search/roma.json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr');

        $jsonData = $response->json();
        dd($jsonData);
        return view('tomtom.tomtomMap', ['jsonData' => $jsonData]);
    }

    /**
     * Toggle on soldout field.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enableToggle(Apartment $apartment)
    {
        $apartment->visible = !$apartment->visible;
        $apartment->save();

        $message = ($apartment->visible) ? "disponibile" : "non disponibile";
        return redirect()->back()->with('alert-type', 'success')->with('alert-message', "$apartment->title:&nbsp;<b>$message</b>");
    }
}
