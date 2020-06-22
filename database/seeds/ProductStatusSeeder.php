<?php

use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductStatus::create([
            "name" => "Stock disponible",
            "rendering" => "success"
        ]);

        \App\Models\ProductStatus::create([
            "name" => "Agotado",
            "rendering" => "danger"
        ]);
    }
}
