<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $this->call( [
            AvisSeeder::class,
            ClientSeeder::class,
            EssenceSeeder::class,
            CategorieSeeder::class,
            OffresTableSeeder::class,
            VisiteurSeeder::class,
            PieceSeeder::class,
            ProduitSeeder::class,
            PanierSeeder::class,
            ContenirPcSeeder::class,
            ContenirPrSeeder::class,
            ConcernerSeeder::class,
            UsersSeeder::class,
        ]);
        
    }
}
