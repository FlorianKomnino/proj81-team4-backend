<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder

{

    public $apartmentsOld = [
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

    public $apartmentsList = [
        [
            "title" => "Ampio appartamento nel cuore di Milano",
            "rooms" => 2,
            "beds" => 3,
            "bathrooms" => 2,
            "square_meters" => 75,
            "address" => "Via Dante Alighieri, 10, Milano",
            "longitude" => 9.1858206,
            "latitude" => 45.4616836,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/9bb7311b-915e-4cc7-a7f2-fa8b253809d6.jpg?im_w=1200",
        ],
        [
            "title" => "Splendido monolocale vicino al Duomo",
            "rooms" => 2,
            "beds" => 4,
            "bathrooms" => 2,
            "square_meters" => 100,
            "address" => "Piazza del Duomo, 2, Milano",
            "longitude" => 9.1914545,
            "latitude" => 45.4640975,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/pro_photo_tool/Hosting-38821495-unapproved/original/d0d61a30-d5b4-4a75-a2cf-5f2b44016cdf.JPEG?im_w=720",
        ],
        [
            "title" => "Appartamento moderno in zona Navigli",
            "rooms" => 3,
            "beds" => 6,
            "bathrooms" => 2,
            "square_meters" => 87,
            "address" => "Via Vigevano, 35, Milano",
            "longitude" => 9.1739413,
            "latitude" => 45.4510239,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-676731691553336193/original/af6193f3-5c97-43d8-af2b-e099c247797e.jpeg?im_w=720",
        ],
        [
            "title" => "Casa con terrazza panoramica a Brera",
            "rooms" => 1,
            "beds" => 1,
            "bathrooms" => 1,
            "square_meters" => 65,
            "address" => "Via Brera, 28, Milano",
            "longitude" => 9.1901952,
            "latitude" => 45.4716069,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/15378504/dfd8fd8b_original.jpg?im_w=720",
        ],
        [
            "title" => "Elegante appartamento in zona Porta Venezia",
            "rooms" => 2,
            "beds" => 3,
            "bathrooms" => 2,
            "square_meters" => 78,
            "address" => "Corso Venezia, 47, Milano",
            "longitude" => 9.2011363,
            "latitude" => 45.4740312,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-770128300661596398/original/817990c0-07f4-4f92-af31-647b078fb3e2.jpeg?im_w=720",
        ],
        [
            "title" => "Appartamento vintage in zona Isola",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 1,
            "square_meters" => 76,
            "address" => "Via Pastrengo, 12, Milano",
            "longitude" => 9.1871021,
            "latitude" => 45.4867439,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-683207046271415572/original/dd1ac907-f1d1-4cef-8b90-4e8be0a913a0.jpeg?im_w=720",
        ],
        [   "title" => "Appartamento moderno in zona centrale",
            "rooms" => 3,  
            "beds" => 4,  
            "bathrooms" => 2,  
            "square_meters" => 120,  
            "address" => "Via Solferino, 10, Milano",  
            "longitude" => 9.192421,  
            "latitude" => 45.474834,  
            "visible" => true,  
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-672349452959295861/original/131f5856-b854-4170-85ca-e792608b8c3c.jpeg?im_w=720",
        ],
        [   "title" => "Casa accogliente vicino al Duomo",  
            "rooms" => 2,  
            "beds" => 2,  
            "bathrooms" => 1,  
            "square_meters" => 70,  
            "address" => "Via Torino, 28, Milano",  
            "longitude" => 9.191234,  
            "latitude" => 45.463928,  
            "visible" => true,  
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-638465566331830237/original/bf204c70-712b-4469-be1e-c8919250fd5a.jpeg?im_w=720",
        ],
        [   "title" => "Monolocale moderno in zona Navigli",  
            "rooms" => 1,  
            "beds" => 1,  
            "bathrooms" => 1,  
            "square_meters" => 55,  
            "address" => "Ripa di Porta Ticinese, 55, Milano",  
            "longitude" => 9.178920,  
            "latitude" => 45.449102,  
            "visible" => true,  
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-46795953/original/7b7f3766-4207-47e6-bf8d-1fb21e178972.jpeg?im_w=720",
        ],
        [   "title" => "Appartamento di lusso nel cuore di Milano",  
            "rooms" => 4,  
            "beds" => 5,  
            "bathrooms" => 3,  
            "square_meters" => 80,  
            "address" => "Via Montenapoleone, 10, Milano",  
            "longitude" => 9.193620,  
            "latitude" => 45.470256,  
            "visible" => true,  
            "image" => "https://a0.muscache.com/im/pictures/miso/Hosting-39352949/original/addecb6a-f071-4a47-8320-5367c119f5b1.jpeg?im_w=720",
        ],
        [
            "title" => "Elegante appartamento nel centro storico di Roma",
            "rooms" => 3,
            "beds" => 2,
            "bathrooms" => 1,
            "square_meters" => 150,
            "address" => "Via del Corso, 123, Roma",
            "longitude" => 12.4831,
            "latitude" => 41.9004,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/8da45c3b-c574-481d-9352-fba1b56015d3.jpg?im_w=720"
        ],
        [
            "title" => "Ampio monolocale con vista su Piazza Navona",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 2,
            "square_meters" => 84,
            "address" => "Piazza Navona, 1, Roma",
            "longitude" => 12.4736,
            "latitude" => 41.8987,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/79e62188-16f0-439e-abd8-93aeab7cd72e.jpg?im_w=720"
        ],
        [
            "title" => "Accogliente bilocale nei pressi della Stazione Termini",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 2,
            "square_meters" => 84,
            "address" => "Via Giovanni Giolitti, 34, Roma",
            "longitude" => 12.5032,
            "latitude" => 41.9015,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/9e3ea4d5-a955-4aa2-bc13-e5ab5ac0b197.jpg?im_w=720"
        ],
        [
            "title" => "Appartamento di design nel quartiere Monti",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 2,
            "square_meters" => 84,
            "address" => "Via Urbana, 123, Roma",
            "longitude" => 12.4914,
            "latitude" => 41.8923,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/pro_photo_tool/Hosting-41739453-unapproved/original/71ee5ae5-004d-42d6-b473-04d4eff646ae.JPEG?im_w=720"
        ],
        [
            "title" => "Bilocale con terrazza panoramica sul Colosseo",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 2,
            "square_meters" => 84,
            "address" => "Via di San Giovanni in Laterano, 123, Roma",
            "longitude" => 12.5053,
            "latitude" => 41.8886,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/9d8d17f8-bf31-4250-8e66-c73e7506390b.jpg?im_w=720"
        ],
        [
            "title" => "Monolocale moderno in zona Trastevere",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 2,
            "square_meters" => 84,
            "address" => "Via del Moro, 1, Roma",
            "longitude" => 12.4689,
            "latitude" => 41.8895,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/228c35b4-9929-4c64-a43a-bdc64159f225.jpg?im_w=720"
        ],
        [
            "title" => "Appartamento nel cuore di Roma",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 1,
            "square_meters" => 80,
            "address" => "Via dei Fori Imperiali, 1",
            "longitude" => 12.485042,
            "latitude" => 41.892554,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/monet/Select-12507976/original/c9f7a390-0d75-46fd-aee8-335ed457bfe0?im_w=720"
        ],
        [
            "title" => "Stanza panoramica in Trastevere",
            "rooms" => 1,
            "beds" => 1,
            "bathrooms" => 1,
            "square_meters" => 60,
            "address" => "Vicolo dell'Aquila, 2",
            "longitude" => 12.467721,
            "latitude" => 41.890188,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/3041aed7-f3b5-492f-9850-3b7a0c15f30c.jpg?im_w=720"
        ],
        [
            "title" => "Ampio loft nel quartiere San Lorenzo",
            "rooms" => 3,
            "beds" => 3,
            "bathrooms" => 2,
            "square_meters" => 120,
            "address" => "Via dei Volsci, 30",
            "longitude" => 12.524598,
            "latitude" => 41.898368,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/3fbb686e-2547-4259-9e42-30c68da9907b.jpg?im_w=720"
        ],
        [
            "title" => "Monolocale in zona Piazza Navona",
            "rooms" => 1,
            "beds" => 1,
            "bathrooms" => 1,
            "square_meters" => 50,
            "address" => "Via della Pace, 23",
            "longitude" => 12.470790,
            "latitude" => 41.899731,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/efa225b6-de59-4f70-9e49-f59c2d6688d9.jpg?im_w=720"
        ],
        [
            "title" => "Appartamento con vista sui Fori Imperiali",
            "rooms" => 2,
            "beds" => 2,
            "bathrooms" => 1,
            "square_meters" => 70,
            "address" => "Via Cavour, 1",
            "longitude" => 12.494132,
            "latitude" => 41.895615,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/4948a332-9553-4cca-81d9-9c0a36446dfa.jpg?im_w=720"
        ],
        [
            "title" => "Trilocale in zona San Giovanni",
            "rooms" => 3,
            "beds" => 3,
            "bathrooms" => 2,
            "square_meters" => 90,
            "address" => "Via Tuscolana, 11",
            "longitude" => 12.519471,
            "latitude" => 41.883197,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/c906d15f-59c1-4f35-bb77-3657a95cf54a.jpg?im_w=720"
        ],
        [
            "title" => "Camera singola nel quartiere Esquilino",
            "rooms" => 1,
            "beds" => 1,
            "bathrooms" => 1,
            "square_meters" => 40,
            "address" => "Via dello Statuto, 22",
            "longitude" => 12.502646,
            "latitude" => 41.897933,
            "visible" => true,
            "image" => "https://a0.muscache.com/im/pictures/da3bb180-6284-42cf-8bc0-4071141f1f65.jpg?im_w=720"
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->apartmentsList as $apartment) {
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
