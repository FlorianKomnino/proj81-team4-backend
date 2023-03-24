<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
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

    public function servicesFilter(Request $request)
    {
        $data = $request->query();
        $filters = $data['services'];

        $filteredApartments = Apartment::with('services')
            ->where('visible', 1)
            ->whereExists(function ($query) use ($filters) {
                $query->select(DB::raw(1))
                    ->from('apartment_service')
                    ->whereIn('service_id', $filters)
                    ->whereRaw('apartment_service.apartment_id = apartments.id')
                    ->groupBy('apartment_id')
                    ->havingRaw('COUNT(DISTINCT apartment_service.service_id) = ?', [count($filters)]);
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $filteredApartments,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
