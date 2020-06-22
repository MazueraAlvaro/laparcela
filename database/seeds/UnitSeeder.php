<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Unit::create([
            "name" => "Gramo",
            "code" => "gramo",
            "unit" => "g",
            "increment" => 100
        ]);

        \App\Models\Unit::create([
            "name" => "Libra",
            "code" => "libra",
            "unit" => "lb",
            "increment" => 0.5
        ]);

        \App\Models\Unit::create([
            "name" => "Unidad",
            "code" => "unidad",
            "unit" => "und",
            "increment" => 1
        ]);

        \App\Models\Unit::create([
            "name" => "Bandeja",
            "code" => "bandeja",
            "unit" => "bandeja",
            "increment" => 1
        ]);

        \App\Models\Unit::create([
            "name" => "Paquete",
            "code" => "paquete",
            "unit" => "pqte",
            "increment" => 1
        ]);
    }
}
