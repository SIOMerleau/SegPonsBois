<?php

namespace Database\Seeders;

use App\Models\Visiteur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  @return void
     */
    public function run(): void
    {
        //
        Visiteur::create([  

            'nomVisiteur' => 'Ernoult',
            'prenomVisiteur' => 'Gabin',
            'telVisiteur' => '0536241526',
            'mailVisiteur' => 'Ernoultgabin@gmail.com',
            'dateContact' => '2024-11-22',
            'messageContact' => 'Je m appelle gabin ernoult',
            'idVisiteur' => 1,
        ]);
    }
}
