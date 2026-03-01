<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pathToImages = resource_path('photo/');
       

        DB::table('essence')->insert([
            [ 'varieteEssence' => 'Alisier', 'typeEssence' => 'Européenne', 'nomLatinEssence' => 'Alisier', 'origineEssence' => 'Europe', 'densiteEssence' => '700 à 800kg/m3', 'durabiliteEssence' => 'Excellente', 'commentaireEssence' => 'Il se tourne très bien s\'il est bien coupé', 'photoEssence' =>$this->getPhotoBinary($pathToImages . 'bois2.jpg')],
            [ 'varieteEssence' => 'Cerisier', 'typeEssence' => 'Européenne', 'nomLatinEssence' => 'Cerisier', 'origineEssence' => 'Europe', 'densiteEssence' => '700 à 800kg/m3', 'durabiliteEssence' => 'Excellente', 'commentaireEssence' => 'commentaire Cerisier', 'photoEssence' =>$this->getPhotoBinary($pathToImages . 'essence_cerisier.jpg-6667002dc1cca.jpg') ],
            [ 'varieteEssence' => 'Albizia', 'typeEssence' => 'Exotique', 'nomLatinEssence' => 'Albizia', 'origineEssence' => 'Afrique', 'densiteEssence' => '500 à 600kg/m3', 'durabiliteEssence' => 'Excellente', 'commentaireEssence' => 'commentaire albizia', 'photoEssence' =>$this->getPhotoBinary($pathToImages . 'bois5.jpg')],
           
        ]);
    }

    private function getPhotoBinary($filePath)
    {
        if (File::exists($filePath)) {
            return File::get($filePath); // Retourne le contenu binaire du fichier
        }
}
}
