<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{

    protected $validationRules = [
        'title' => 'required|unique:apartments|string|min:2|max:255',
        'rooms' => 'int|min:1',
        'beds' => 'int|min:1',
        'bathrooms' => 'int|min:1',
        'square_meters' => 'int',
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
        $data['user_id'] = Auth::user()->id;
        $data['image'] = Storage::put('imgs/', $data['image']);
        $newApartment = new Apartment();
        $newApartment->fill($data);
        $newApartment->save();
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
        return view('user.apartments.show', ['apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('user.apartments.edit', ['apartment' => $apartment]);
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
}
