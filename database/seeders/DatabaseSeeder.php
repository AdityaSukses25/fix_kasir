<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Therapist;
use App\Models\Gender;
use App\Models\Discount;
use App\Models\Place;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Aditya Wardana',
            'username' => 'aditya',
            'phone' => '09832423',
            'status' => 'admin',
            'email' => 'aditya@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        Therapist::create([
            'name' => 'Ni Putu Rai Asih',
            'nickname' => 'rai',
            'phone' => '08311401437',
            'gender_id' => '2',
            'presence' => '30000',
            'commision' => '20000',
        ]);

        Therapist::create([
            'name' => 'Komang Aditya Wardana',
            'nickname' => 'adit',
            'phone' => '08311401437',
            'gender_id' => '1',
            'presence' => '30000',
            'commision' => '25000',
        ]);

        Gender::create([
            'gender' => 'male',
        ]);

        Gender::create([
            'gender' => 'female',
        ]);

        Place::create([
            'place' => 'floor 1',
        ]);

        Place::create([
            'place' => 'floor 2',
        ]);

        Service::create([
            'massage' => 'Balinese',
            'time' => '60',
            'price' => '90',
        ]);

        Discount::create([
            'discount' => '20',
        ]);
    }
}
