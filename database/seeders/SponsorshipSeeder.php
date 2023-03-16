<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{

    public $sponsorships = [
        [
            'type' => 'junior',
            'price' => 2.99,
            'duration_hours' => 24
        ],
        [
            'type' => 'middle',
            'price' => 5.99,
            'duration_hours' => 72
        ],
        [
            'type' => 'senior',
            'price' => 9.99,
            'duration_hours' => 144
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->sponsorships as $sponsorship){
            $newSponsorship = new Sponsorship();
            $newSponsorship->type = $sponsorship['type'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration_hours = $sponsorship['duration_hours'];
            $newSponsorship->save();
        }
    }
}
