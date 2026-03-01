<?php

namespace Database\Seeders;


use App\Models\Offre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offre::create([
            'idOffre' => 2,
            'nomOffre'=> 'Offre de noël',
            'date_debut' => '2024-11-20',
            'date_fin' => '2024-12-20',
        ]);
    }
        
}
