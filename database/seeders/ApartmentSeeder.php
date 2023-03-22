<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder

{

    public $apartments = [
        [
            "title" => "Appartamento elegante nel centro di Firenze",
            "rooms" => 3,
            "beds" => 5,
            "bathrooms" => 2,
            "square_meters" => 100,
            "address" => "Via dei Neri, 7, Firenze",
            "longitude" => 11.256,
            "latitude" => 43.772,
            "visible" => true,
            "image" => "https://www.example.com/apartment.jpg"
        ],
        [
            'title' => 'Loft nel cuore di Roma',
            'rooms' => 7,
            "beds" => 6,
            "bathrooms" => 3,
            "square_meters" => 130,
            "address" => "Via dei Genovesi, 18, Roma",
            "longitude" => 12.476573,
            "latitude" => 41.887800,
            "visible" => false,
            "image" => "https://www.example.com/apartment.jpg"
        ],
        [
            'title' => 'Appartamento con vista sul mare a Sorrento',
            'rooms' => 4,
            "beds" => 3,
            "bathrooms" => 1,
            "square_meters" => 60,
            "address" => "Corso Italia, 221, Sorrento",
            "longitude" => 14.377975,
            "latitude" => 40.626501,
            "visible" => true,
            "image" => "https://www.example.com/apartment.jpg"
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->apartments as $apartment){
            $newApartment = new Apartment();
            $newApartment->title = $apartment['title'];
            $newApartment->user_id = User::inRandomOrder()->first()->id;
            $newApartment->rooms = $apartment['rooms'];
            $newApartment->beds = $apartment['beds'];
            $newApartment->bathrooms = $apartment['bathrooms'];
            $newApartment->square_meters = $apartment['square_meters'];
            $newApartment->address = $apartment['address'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->visible = $apartment['visible'];
            $newApartment->image = $apartment['image'];
            $newApartment->save();
        }
    }
}
