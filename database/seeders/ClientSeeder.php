<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Client::create([
            'nomClient' => 'Ernoult',
            'prenomClient' => 'Gabin',
            'telClient' => '0601020304',
            'mailClient' => 'ernoult.gabin@gmail.com',
            'adRueClient' => '1 rue de la rue la bretagne',
            'adCPClient' => '44000',
            'adVilleClient' => 'Nantes',
            'mdpClient' => 'mdp'

        ]);
    }
}
