<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{

    protected $validationRules = [
        'title' => 'required|unique:apartments|string|min:2|max:255',
        'rooms' => 'int|min:1',
        'beds' => 'int|min:1',
        'bathrooms' => 'int|min:1',
        'square_meters' => 'int',
        'address' => 'string',
        'services' => 'nullable',
        'image' => 'image|max:2048'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
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
        $rules = $this->validationRules;
        $data = $request->validate($rules);
        $response = Http::get("https://api.tomtom.com/search/2/search/" . $data['address'] . ".json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr");
        $jsonData = $response->json();
        $data['user_id'] = Auth::user()->id;
        $data['image'] = Storage::put('imgs/', $data['image']);
        $data['latitude'] = $jsonData['results'][0]['position']['lat'];
        $data['longitude'] = $jsonData['results'][0]['position']['lon'];
        $newApartment = new Apartment();
        $newApartment->fill($data);
        $newApartment->save();
        $newApartment->services()->sync($data['services']??[]);
        $newApartment->update();
        return redirect()->route('user.dashboard');
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
        return view('user.showApartment', ['apartment' => $apartment, 'user' => $user]);
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
        $rules = $this->validationRules;
        $data = $request->validate($rules);
        $apartment->update($data);
        return redirect()->route('user.apartments.show', ['apartment' => $apartment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('user.apartments.index')->with('message', 'The apartment has been removed correctly')->with('message_class', 'danger');
    }

    public function APICall()
    {
        $response = Http::get('https://api.tomtom.com/search/2/search/roma.json?key=jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr');
    
        $jsonData = $response->json();
          
        dd($jsonData);
    }
}
