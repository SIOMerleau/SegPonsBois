<?php

namespace Database\Seeders;

use App\Models\Avis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Avis::create([  

            'dateAvis' => '2024-11-20',
            'texteAvis' => 'Super nickel couteau plonge',
            'etoilesAvis' => 5,
            'idUsers' => 1,
            'idProduit' => 1,
        ]);

        
    }
}