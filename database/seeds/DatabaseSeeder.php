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
            'premium' => false
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john@hotmail.fr',
            'password' => bcrypt('password'),
            'seller' => true,
            'seller_name' => "John's coffee",
            'premium' => false
        ]);

    }
}
