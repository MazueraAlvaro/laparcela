<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Payment::create([
            "name" => "Transferencia Bancaria",
            "active" => true
        ]);

        \App\Models\Payment::create([
            "name" => "Efectivo",
            "active" => true
        ]);
    }
}
