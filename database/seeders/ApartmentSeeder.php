<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            "image" => "https://a0.muscache.com/im/pictures/109246529/045c7d39_original.jpg?im_w=720"
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
            "image" => "https://a0.muscache.com/im/pictures/cbb571f8-8ef7-4d08-8709-8a6d7d8fb0d2.jpg?im_w=720"
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
            "image" => "https://a0.muscache.com/im/pictures/55bf5442-d409-48fa-8a83-5f2814be8968.jpg?im_w=1200"
        ],
        [
            'title' => 'Appartamento in centro a Milano',
            'rooms' => 6,
            'beds' => 4,
            'bathrooms' => 2,
            'square_meters' => 110,
            'address' => 'Piazza Duomo',
            'longitude' => 9.190100,
            'latitude' => 45.464686,
            'visible' => true,
            'image' => 'https://images2-milano.corriereobjects.it/methode_image/2019/06/07/Milano/Foto%20Milano%20-%20Trattate/13212445-kwD-U31201350610578CCF-1224x916@Corriere-Web-Milano-593x443.jpg?v=20190607121922'
        ],
        [
            'title' => 'Appartamento a Navigli',
            'rooms' => 4,
            'beds' => 2,
            'bathrooms' => 1,
            'square_meters' => 70,
            'address' => 'Via Vigevano, 1',
            'longitude' => 9.173420,
            'latitude' => 45.459101,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-848655827363323415/original/4652b4e5-2f0b-4a4b-8d72-b8a0c614ebcc.jpeg?im_w=720'
        ],
        [
            'title' => 'Monolocale in zona Isola',
            'rooms' => 1,
            'beds' => 1,
            'bathrooms' => 1,
            'square_meters' => 25,
            'address' => 'Via Pastrengo, 10',
            'longitude' => 9.187883,
            'latitude' => 45.483702,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-627942620745780550/original/18f2a4f2-60e0-4244-bd9c-92caac6c140a.jpeg?im_w=720'
        ],
        [
            'title' => 'Appartamento in zona Cadorna',
            'rooms' => 3,
            'beds' => 2,
            'bathrooms' => 2,
            'square_meters' => 100,
            'address' => 'Via San Giovanni sul Muro, 2',
            'longitude' => 9.179100,
            'latitude' => 45.468836,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-54222567/original/32621638-02dd-4bf9-b1ec-0dcc70f3fd11.jpeg?im_w=720'
        ],
        [
            'title' => 'Attico con terrazza a Porta Venezia',
            'rooms' => 5,
            'beds' => 3,
            'bathrooms' => 2,
            'square_meters' => 150,
            'address' => 'Corso Buenos Aires, 1',
            'longitude' => 9.203228,
            'latitude' => 45.476946,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/prohost-api/Hosting-856236351660390963/original/cc23377d-77a9-4c0c-add7-3d0a3ed4ce32.jpeg?im_w=720'
        ],
        [
            'title' => 'Appartamento in zona Loreto',
            'rooms' => 4,
            'beds' => 2,
            'bathrooms' => 1,
            'square_meters' => 90,
            'address' => 'Via Padova, 5',
            'longitude' => 9.213342,
            'latitude' => 45.486451,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/d1bc9ac8-db6b-4dea-85ac-74c2cd3c1bc8.jpg?im_w=720'
        ],
        [
            'title' => 'Appartamento in zona Porta Romana',
            'rooms' => 3,
            'beds' => 2,
            'bathrooms' => 1,
            'square_meters' => 80,
            'address' => 'Via Filippetti, 10',
            'longitude' => 9.203790,
            'latitude' => 45.459501,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-848413992007992720/original/1e9855d6-b07f-4eed-b3bf-9bc2cff3d3e5.jpeg?im_w=720'
        ],
        [
            'title' => 'Appartamento in zona Brera',
            'rooms' => 6,
            'beds' => 4,
            'bathrooms' => 2,
            'square_meters' => 120,
            'address' => 'Via Solferino, 15',
            'longitude' => 9.190666,
            'latitude' => 45.473501,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-45527997/original/c8ca4b7d-5e35-4c0c-b39b-a331d1992480.jpeg?im_w=720'
        ],
        [
            'title' => 'Villa a due passi dal Parco Sempione',
            'rooms' => 8,
            'beds' => 4,
            'bathrooms' => 2,
            'square_meters' => 180,
            'address' => 'Via Canonica, 12',
            'longitude' => 9.171450,
            'latitude' => 45.476109,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-803555751714324246/original/4305f16c-db7d-4d9e-b5a6-2fe2d0ec13a6.jpeg?im_w=720'
        ],
        [
            'title' => 'Bilocale in zona Bovisa',
            'rooms' => 2,
            'beds' => 1,
            'bathrooms' => 1,
            'square_meters' => 40,
            'address' => 'Via Benadir, 8',
            'longitude' => 9.165940,
            'latitude' => 45.512038,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/9e8792cd-2142-4d86-a976-91fcfd3dbfc0.jpg?im_w=720'
        ],
        [
            'title' => 'Appartamento in zona Porta Genova',
            'rooms' => 10,
            'beds' => 7,
            'bathrooms' => 4,
            'square_meters' => 75,
            'address' => 'Via Bergognone, 34',
            'longitude' => 9.176800,
            'latitude' => 45.454429,
            'visible' => true,
            'image' => 'https://a0.muscache.com/im/pictures/miso/Hosting-629403799322388308/original/f555cb2b-c8d8-4bb1-9d7b-0b15109eddd3.jpeg?im_w=720'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->apartments as $apartment) {
            $newApartment = new Apartment();
            $newApartment->title = $apartment['title'];
            $newApartment->slug = Str::slug($newApartment->title);
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
