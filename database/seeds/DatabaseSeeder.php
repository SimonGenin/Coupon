<?php

use App\Tag;
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

    }
}
