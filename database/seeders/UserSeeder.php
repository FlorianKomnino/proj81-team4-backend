<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = 'Sebastiano';
        $newUser->surname = 'Calella';
        $newUser->birth_date = '1997-03-07';
        $newUser->email = 'sebastianocalella97@gmail.com';
        $newUser->password = Hash::make('ciaociao');
        $newUser->save();
    }
}
