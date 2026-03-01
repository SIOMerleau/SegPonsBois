<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Création d'un utilisateur administrateur avec le mot de passe du fichier ENV
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin-essence@gmail.com',
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'is_admin' => true,
        ]);
    }
}
