<?php

namespace Database\Seeders;
use App\Models\Panier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        // Create a few paniers
        $panier1 = Panier::create([
            'idClient' => 1,
            'datePanier' => '2024-11-22',
            'total_price' => 100.00,
            'status' => 1,
        ]);

        $panier2 = Panier::create([
            'idClient' => 2,
            'datePanier' => '2024-11-23',
            'total_price' => 50.50,
            'status' => 0,
        ]);
    }
}