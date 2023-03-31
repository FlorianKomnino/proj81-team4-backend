<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Apartment;
use App\Models\Visualization;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


    public function getVisualizationStats()
    {
        $allVisualizationForThisApartment = Visualization::where('apartment_id', 4)->get();
        return redirect()->back()->with($allVisualizationForThisApartment);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->orderBy('email', 'asc')->get();
        return view('user.message.indexApartmentMessage', compact('messages', 'apartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->back();
    }

    /**
     * Toggle on soldout field.
     *
     * @param  Message $message
     * @return \Illuminate\Http\Response
     */
    public function enableToggle(Message $message)
    {
        $message->status = !$message->status;
        $message->save();
        return redirect()->back()->with('alert-type', 'success');
    }
}
