<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PieceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathToImages = resource_path('photo/');

        DB::table('piece')->insert([
            [
                'typePiece' => 'Carrelet 2*2cm',
                'commentaire' => 'Paire de carrelet de 15 cm de longueur',
                'referencePiece' => '001',
                'prixHTPiece' => 1,
                'stockPiece' => 200,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'),
                'idEssence' => 1
            ],
            [
                'typePiece' => 'Carrelet 4*4cm',
                'commentaire' => 'Paire de carrelet de 15 cm de longueur',
                'referencePiece' => '002',
                'prixHTPiece' => 3,
                'stockPiece' => 50,
                'exportablePiece' => 0,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 1
            ],
            [
                'typePiece' => 'Plaquette',
                'commentaire' => 'Paire plaquette',
                'referencePiece' => '003',
                'prixHTPiece' => 2.5,
                'stockPiece' => 100,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 1
            ],
            [
                'typePiece' => 'Carrelet 2*2cm',
                'commentaire' => 'Paire de carrelet de 24cm',
                'referencePiece' => '004',
                'prixHTPiece' => 1,
                'stockPiece' => 300,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 2
            ],
            [ 
                'typePiece' => 'Carrelet 2*3cm',
                'commentaire' => 'Paire de carrelet de 24cm',
                'referencePiece' => '005',
                'prixHTPiece' => 2.5,
                'stockPiece' => 50,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 2
            ],
            [ 
                'typePiece' => 'Plaquette',
                'commentaire' => 'Paire de plaquette de 20 cm',
                'referencePiece' => '006',
                'prixHTPiece' => 3, 'stockPiece' => 100,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 2
            ],
            [ 
                'typePiece' => 'Carrelet 4*4cm',
                'commentaire' => 'Bonne paire de carrelet de 4*4',
                'referencePiece' => '009',
                'prixHTPiece' => 4,
                'stockPiece' => 40,
                'exportablePiece' => 1,
                'photoPiece' => $this->getPhotoBinary($pathToImages . 'bois2.jpg'), 
                'idEssence' => 3
            ]
        ]);
    }

    private function getPhotoBinary($filePath)
    {
        if (File::exists($filePath)) {
            return File::get($filePath); // Retourne le contenu binaire du fichier
        }
}
}
