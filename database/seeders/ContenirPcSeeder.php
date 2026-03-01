<?php

namespace Database\Seeders;
use App\Models\ContenirPc;
use App\Models\Panier;
use App\Models\Piece;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContenirPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContenirPc::create([
            'quantitePc' => 2,
            'prixPc' => 19.99,
            'panier_id' => 1,
            'piece_id' => 1,
        ]);
    }
}
