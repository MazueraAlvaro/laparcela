<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tag::create([
             "name" => "jugo"
        ]);

        \App\Models\Tag::create([
            "name" => "ensalada"
        ]);

    }
}
