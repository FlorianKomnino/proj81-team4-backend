<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{

    public $services = [
        [
            'name' => 'cucina',
            'icon' => 'fa-solid fa-hat-chef'
        ],
        [
            'name' => 'wi-fi',
            'icon' => 'fa-solid fa-wifi'
        ],
        [
            'name' => 'piscina',
            'icon' => 'fa-solid fa-water-ladder'
        ],
        [
            'name' => 'Parcheggio gratuito',
            'icon' => 'fa-solid fa-square-parking'
        ],
        [
            'name' => 'Servizio di trasporto',
            'icon' => 'fa-solid fa-bus'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->services as $service){
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->icon = $service['icon'];
            $newService->save();
        }
    }
}
