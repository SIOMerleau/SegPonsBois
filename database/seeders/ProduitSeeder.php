<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pathToImages = resource_path('photo/');


        DB::table('produit')->insert([
            [ 'designationProduit' => 'ouvert', 'prixProduit' => 20.9, 'stockProduit' => 3, 'photoProduit' =>$this->getPhotoBinary($pathToImages . 'nichoir_ouvert.jpg'), 'idCategorie' => 1, 'descriptionProduit' => 'C\'est un très bon produit'],
            [ 'designationProduit' => 'NAB', 'prixProduit' => 30, 'stockProduit' => 1, 'photoProduit' => $this->getPhotoBinary($pathToImages . 'nichoir_nab.jpg'), 'idCategorie' => 1, 'descriptionProduit' => 'C\'est un très bon produit'],
            [ 'designationProduit' => 'Puissance 4', 'prixProduit' => 25, 'stockProduit' => 5, 'photoProduit' =>$this->getPhotoBinary($pathToImages . 'p4.jpg') , 'idCategorie' => 2, 'descriptionProduit' => 'C\'est un très bon produit'],
            ['designationProduit' => 'Solitaire', 'prixProduit' => 20, 'stockProduit' => 5, 'photoProduit' =>$this->getPhotoBinary($pathToImages . 'solitaire_en_bois.jpg-666805d01c2dc.jpg') , 'idCategorie' => 2, 'descriptionProduit' => 'C\'est un très bon produit']
        ]);
    }


    private function getPhotoBinary($filePath)
    {
        if (File::exists($filePath)) {
            return File::get($filePath); // Retourne le contenu binaire du fichier
        }
}
}
