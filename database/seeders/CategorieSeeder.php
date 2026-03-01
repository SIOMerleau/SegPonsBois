<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie')->insert([
            [ 'libelleCategorie' => 'Nichoir'],
            [ 'libelleCategorie' => 'Objets bois']
        ]);
    }
}
