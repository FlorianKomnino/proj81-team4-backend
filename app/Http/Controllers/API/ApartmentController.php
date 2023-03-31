<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\Message;
use App\Models\Service;
use App\Models\Visualization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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
                ->with('sponsorships')
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
                ->with('sponsorships')
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

        $validator = Validator::make(
            $data,
            [
                'name' => 'nullable',
                'email' => 'required',
                'text_content' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $receivedMessage = new Message();
        $receivedMessage->fill($data);
        $receivedMessage->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function sponsoredApartments(Sponsorship $sponsorship, Apartment $apartment)
    {
        $allSponsoredApartments = DB::table('apartment_sponsorship')->orderBy('id', 'desc')->where('ending_time', '>', now())->get();
        $idSponsoredApartmentsNow = [];
        foreach ($allSponsoredApartments as $sponsoredApartment) {
            array_push($idSponsoredApartmentsNow, $sponsoredApartment->apartment_id);
        }
        $apartmentsToShow = Apartment::with('services')->where('visible', 1)->whereIn('apartments.id', $idSponsoredApartmentsNow)->get();
        return response()->json([
            'success' => true,
            'results' => $apartmentsToShow
        ]);
    }

    public function receiveVisualization(Request $request, Apartment $apartment)
    {

        $dataFromClient = $request->query();

        $possibleRowChecked = Visualization::where('user_ip', $dataFromClient['clientIp'])->where('apartment_id', $dataFromClient['apartment_id'])->orderBy('created_at', 'desc')->get()->first();

        if ($possibleRowChecked) {
            if (Carbon::parse($possibleRowChecked['created_at']) < now()->addHours(2)->subMinute()) {
                $newVisualization = new Visualization();
                $newVisualization->apartment_id = $dataFromClient['apartment_id'];
                $newVisualization->user_ip = $dataFromClient['clientIp'];
                $newVisualization->created_at = now()->addHours(2);
                $newVisualization->save();
            } else {
            }
        } else {
            $newVisualization = new Visualization();
            $newVisualization->apartment_id = $dataFromClient['apartment_id'];
            $newVisualization->user_ip = $dataFromClient['clientIp'];
            $newVisualization->created_at = now()->addHours(2);
            $newVisualization->save();
        }
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
        $apartment = Apartment::with('services')->findOrFail($apartment->id);
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
