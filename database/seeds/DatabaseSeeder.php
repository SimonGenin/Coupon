<?php

use App\Tag;
use App\User;
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

        Tag::create([
            'name' => 'shopping'
        ]);

        Tag::create([
            'name' => 'biere'
        ]);

        Tag::create([
            'name' => 'bar'
        ]);

        Tag::create([
            'name' => 'vin'
        ]);

        Tag::create([
            'name' => 'apero'
        ]);

        Tag::create([
            'name' => 'restorant'
        ]);

        Tag::create([
            'name' => 'fast-food'
        ]);

        Tag::create([
            'name' => 'lunch'
        ]);

        Tag::create([
            'name' => 'fourniture'
        ]);

        User::create([
            'name' => 'Simon',
            'email' => 'simongenin@hotmail.fr',
            'password' => bcrypt('password'),
            'seller' => false,
            'premium' => true
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john@hotmail.fr',
            'password' => bcrypt('password'),
            'seller' => true,
            'seller_name' => "Pizza Chef",
            'premium' => true,
            'latitude' => 50.46674,
            'longitude' => 4.86001,
            'distance_from_user' => 19
        ]);

        $cercle = User::create([
            'name' => 'Luc',
            'email' => 'luc@hotmail.fr',
            'password' => bcrypt('password'),
            'seller' => true,
            'seller_name' => "Cercle Médecine",
            'premium' => true,
            'latitude' => 50.46597,
            'longitude' => 4.85996,
            'distance_from_user' => 72
        ]);

        $cercle->tags()->attach(2);

        User::create([
            'name' => 'Fanny',
            'email' => 'fanny@hotmail.fr',
            'password' => bcrypt('password'),
            'seller' => true,
            'seller_name' => "Le Bouffon du Roi",
            'premium' => true,
            'latitude' => 50.46618,
            'longitude' => 4.86091,
            'distance_from_user' => 71
        ]);

        /*
         *
         *  $table->bigIncrements('id');
            $table->string("title");
            $table->string("title_premium");
            $table->text("description")->nullable();
            $table->dateTime("start");
            $table->integer("length");
            $table->integer("distance");
            $table->integer("owner_id")->default(2);
         */

        $pizzeria = \App\Announcement::create([

            'title' => "2 pizzas achetées, une offerte",
            'title_premium' => "Une boisson offerte",
            'start' => now()->subMinutes(3),
            'length' => 40,
            'distance' => 80,
            'owner_id' => 2

        ]);

        $pizzeria->owner->tags()->attach([7, 8]);

        $roi = \App\Announcement::create([

            'title' => "6 besos, 2 offertes",
            'title_premium' => "Une chartreuse offerte",
            'start' => now()->subMinutes(16),
            'length' => 100,
            'distance' => 120,
            'owner_id' => 4

        ]);

        $roi->owner->tags()->attach([3, 2]);

    }
}
