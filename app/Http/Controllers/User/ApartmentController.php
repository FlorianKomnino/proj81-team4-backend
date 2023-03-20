<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{

    protected $validationRules = [
        'title' => 'required|unique:apartments|string|min:2|max:255',
        'rooms' => 'number|min:1',
        'beds' => 'number|min:1',
        'bathrooms' => 'number|min:1',
        'square_meters' => 'number',
        'address' => 'string',
        'image' => 'image|max:2048'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *@param Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        return view('user.apartment.create', ['apartment' => new Apartment()]);
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
        $data['image'] =  Storage::put('imgs/', $data['image']);

        $newApartment = new Apartment();
        $newApartment->title = $data['title'];
        $newApartment->rooms = $data['rooms'];
        $newApartment->beds = $data['beds'];
        $newApartment->bathrooms = $data['bathrooms'];
        $newApartment->square_meters = $data['square_meters'];
        $newApartment->address = $data['address'];
        $newApartment->image = $data['image'];
        // $newApartment->longitude = 'longitude' from tomtom;
        // $newApartment->latitude = 'latitude' from tomtom;
        // $newApartment->visible = TO DO;
        $newApartment->save();

        return redirect()->route('user.apartment.show', $newApartment->id)->with('message', "L\'appartamento '$newApartment->title', è stato creato con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view ('user.apartments.show',['apartment'=>$apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('user.apartments.edit', ['apartment'=>$apartment]);
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
        return redirect()->route('user.apartments.show', ['apartment'=>$apartment]);
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
        return redirect()->route('user.apartments.index')->with('message', 'The apartment has been removed correctly')->with('message_class','danger');
    }
}
