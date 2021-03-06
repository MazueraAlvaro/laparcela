<?php

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
         $this->call([
             UserTableSeeder::class,
             CategorySeeder::class,
             TagSeeder::class,
             PaymentSeeder::class,
             UnitSeeder::class,
             ProductStatusSeeder::class,
             ProductSeeder::class,
             ProductImageSeeder::class
         ]);
    }
}
