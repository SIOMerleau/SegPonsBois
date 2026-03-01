<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenirPrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contenirpr')->insert([
            ['quantitePr' => 10, 'prixPr' => 100.0, 'idProd_Produit' => 1, 'idPanier' => 1],
            // Ajoute d'autres entrées si nécessaire
        ]);
    }
}
