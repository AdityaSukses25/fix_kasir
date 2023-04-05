<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Order;
use App\Models\Place;
use App\Models\Gender;
use App\Models\Service;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Therapist;
use Illuminate\Database\Seeder;

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
            'status' => 1,
            'email' => 'aditya@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        User::factory(5)->create();
        Therapist::factory(10)->create();
        Order::factory(20)->create();

        User::create([
            'name' => 'Ni Putu Rai Asih',
            'username' => 'raiasih',
            'phone' => '09832423',
            'status' => 2,
            'email' => 'aditya11@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        Gender::create([
            'gender' => 'Male',
        ]);

        Gender::create([
            'gender' => 'Female',
        ]);

        Place::create([
            'place' => 'Yudistira',
            'status' => '2',
        ]);

        Place::create([
            'place' => 'Bima',
            'status' => '2',
        ]);

        Place::create([
            'place' => 'Arjuna',
            'status' => '2',
        ]);
        Place::create([
            'place' => 'Nakula',
            'status' => '2',
        ]);
        Place::create([
            'place' => 'Sahadewa',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Balinese',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Deep Tissue',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Surfer',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Shiatsu',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Aromatherapy',
            'time' => '60',
            'price' => '220000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Anti-Cellulite/Sliming',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Facial',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Body Scrub',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);

        Service::create([
            'massage' => 'Indian Head Massage',
            'time' => '30',
            'price' => '100000',
            'status' => '2',
        ]);
        Service::create([
            'massage' => 'Foot Massage',
            'time' => '60',
            'price' => '200000',
            'status' => '2',
        ]);
        Service::create([
            'massage' => 'Ear Candle',
            'time' => '60',
            'price' => '100000',
            'status' => '2',
        ]);
        Service::create([
            'massage' => 'Extra Aloevera',
            'time' => '60',
            'price' => '70000',
            'status' => '2',
        ]);

        Discount::create([
            'discount' => '0',
            'status' => '2',
        ]);

        Discount::create([
            'discount' => '5',
            'status' => '2',
        ]);
        Discount::create([
            'discount' => '10',
            'status' => '2',
        ]);
        Discount::create([
            'discount' => '15',
            'status' => '2',
        ]);
        Discount::create([
            'discount' => '20',
            'status' => '2',
        ]);
        Discount::create([
            'discount' => '30',
            'status' => '2',
        ]);
    }
}
