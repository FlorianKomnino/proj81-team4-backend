<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::with('services')->where('apartments.visible', 1)->get();
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

    public function servicesFilter(Request $request, $rooms = 1, $beds = 1)
    {
        $data = $request->query();

        if (isset($data['services'])) {
            $filters = $data['services'];

            $filteredApartments = Apartment::with('services')
                ->where('visible', 1)
                ->where('rooms', '>=', $rooms)
                ->where('beds', '>=', $beds)
                ->whereExists(function ($query) use ($filters) {
                    $query->select(DB::raw(1))
                        ->from('apartment_service')
                        ->whereIn('service_id', $filters)
                        ->whereRaw('apartment_service.apartment_id = apartments.id')
                        ->groupBy('apartment_id')
                        ->havingRaw('COUNT(DISTINCT apartment_service.service_id) = ?', [count($filters)]);
                })
                ->get();
        } else {
            $filteredApartments = Apartment::with('services')
                ->where('apartments.visible', 1)
                ->where('rooms', '>=', $rooms)
                ->where('beds', '>=', $beds)
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $filteredApartments,
        ]);
    }

    public function receivedMessage(Request $request)
    {
        $data = $request->all();
        $receivedMessage = new Message();

        $receivedMessage->text_content = $data['text_content'];
        $receivedMessage->email = $data['email'];
        $receivedMessage->apartment_id = $data['apartment_id'];
        $receivedMessage->name = $data['name'];
        $receivedMessage->save();
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
    public function show(Apartment $apartment)
    {
        $apartment = Apartment::findOrFail($apartment->id);
        return response()->json([
            'status' => 'success',
            'data' => $apartment,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
