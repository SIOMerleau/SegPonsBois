<?php

namespace Database\Seeders;

use App\Models\Concerner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConcernerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Concerner::create([
            'prixOffre' => 20,
            'quantiteOf' => 5,
            'idProd_Produit' => 2,
            'idOffre' => 2,
        ]);
    }
}
