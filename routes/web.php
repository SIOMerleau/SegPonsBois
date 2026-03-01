<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\EssenceController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
//Auth
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;     
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\AvisController;


//Accueil
Route::get('/', function () {
    return view('accueil');
});




//route avis
Route::post('/avis/store', [AvisController::class, 'store'])->name('avis.store');

//route offres
Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
Route::get('/offre/{id}', [OffreController::class, 'show'])->name('offres.show');

//--------------------Route Boutique--------------------
Route::get('/boutique', function () { return view('boutique'); })->name('boutique');
//Routes pour visualiser les essences//route essence
Route::get('/essence', [EssenceController::class, 'index'])->name('essence.index');
Route::get('/essence/{id}', [EssenceController::class, 'show'])->name('essence.show');
//route produit
Route::get('/produit', [ProduitController::class, 'index'])->name('produit.index');
Route::get('/produit/{id}', [ProduitController::class, 'show'])->name('produit.show');
//route piece
Route::get('/piece', [PieceController::class, 'index'])->name('piece.index');
Route::get('/piece/{id}', [PieceController::class, 'show'])->name('piece.show');

//--------------------Route Authentification Session--------------------
//Auth Inscription
Route::get('/inscription', [RegisterController::class, 'create'])->name('user.create');
Route::post('/inscription', [RegisterController::class, 'store'])->name('user.store');
//Auth connexion
Route::get('/connexion', [LoginController::class, 'index'])->name('user.index');
Route::post('/connexion', [LoginController::class, 'login'])->name('user.login');
//Auth déconnexion
Route::get('/deconnexion', [LogoutController::class, 'destroy'])->middleware('auth')->name('user.logout');

//route boutique
Route::get('/boutique', function () { return view('boutique'); })->name('boutique');


//Route pour afficher le formulaire de contact et de créer un message
Route::get('/contact',[VisiteurController::class, 'create'])->name('contact.create');
Route::post('/contact',[VisiteurController::class, 'store'])->name('contact.store');


//--------------------Route réserver pour l'administrateur--------------------
Route::get('/admin/dashboard',[AdminController::class, 'index'])->middleware('auth')->name('admin.dashboard');
//Route pour supprimer un message d'un contact
Route::post('/admin/dashboard',[AdminController::class, 'destroyMessage'])->middleware('auth')->name('admin.destroyMessage');

//--------------------Route réserver pour le Dashboard Administrateur--------------------

//--------------------CATEGORIE DASHBOARD--------------------
Route::get('admin/categorie/index', [CategorieController::class, 'index' ])->middleware('auth')->name('admin.categorie.index');
//Créer une catégorie
Route::post('admin/categorie/index', [CategorieController::class, 'create' ])->middleware('auth')->name('admin.categorie.create');
//Modifier une catégorie
Route::put('admin/categorie/index', [CategorieController::class, 'update' ])->middleware('auth')->name('admin.categorie.update');
//Supprimer une catégorie
Route::delete('admin/categorie/{idCategorie}', [CategorieController::class, 'destroy' ])->middleware('auth')->name('admin.categorie.destroy');
//--------------------PRODUIT DASHBOARD--------------------
Route::get('admin/produit/index', [ProduitController::class, 'index_dashboard'])->middleware('auth')->name('admin.produit.index');
//Créer un produit
Route::post('admin/produit/index', [ProduitController::class, 'store'])->middleware('auth')->name('admin.produit.create');
//Modifier un produit
Route::put('admin/produit/index', [ProduitController::class, 'update'])->middleware('auth')->name('admin.produit.update');
//Supprimer un produit
Route::delete('admin/produit/{idProd}', [ProduitController::class, 'destroy'])->middleware('auth')->name('admin.produit.destroy');
//--------------------Offre DASHBOARD--------------------
Route::middleware('auth')->group(function() {
    Route::get('admin/offre/index', [OffreController::class, 'adminIndex'])->name('admin.offre.index');
    Route::post('admin/offre/index', [OffreController::class, 'store'])->name('admin.offre.store');
    Route::get('admin/offre/create', [OffreController::class, 'create'])->name('admin.offre.create');
    Route::get('admin/offre/{idOffre}/edit', [OffreController::class, 'edit'])->name('admin.offre.edit');
    Route::put('admin/offre/{idOffre}', [OffreController::class, 'update'])->name('admin.offre.update');
    Route::delete('admin/offre/{idOffre}', [OffreController::class, 'destroy'])->name('admin.offre.destroy');
});
//--------------------ESSENCE DASHBOARD--------------------
Route::get('admin/essence/index', [EssenceController::class, 'index_dashboard'])->middleware('auth')->name('admin.essence.index');
//Créer une essence
Route::post('admin/essence/index', [EssenceController::class, 'store'])->middleware('auth')->name('admin.essence.create');
//Modifier une essence
Route::put('admin/essence/index', [EssenceController::class, 'update'])->middleware('auth')->name('admin.essence.update');
//Supprimer une essence
Route::delete('admin/essence/{idEssence}', [EssenceController::class, 'destroy'])->middleware('auth')->name('admin.essence.destroy');
//--------------------PIECE DASHBOARD--------------------
Route::get('admin/piece/index', [PieceController::class, 'index_dashboard'])->middleware('auth')->name('admin.piece.index');
//Créer une essence
Route::post('admin/piece/index', [PieceController::class, 'store'])->middleware('auth')->name('admin.piece.create');
//Modifier une essence
Route::put('admin/piece/index', [PieceController::class, 'update'])->middleware('auth')->name('admin.piece.update');
//Supprimer une essence
Route::delete('admin/piece/{idPiece}', [PieceController::class, 'destroy'])->middleware('auth')->name('admin.piece.destroy');

//--------------------Route pour le dashboard client--------------------
Route::get('/client/dashboard', [UserController::class, 'index'])->middleware('auth')->name('user.dashboard');
Route::post('/client/dashboard', [UserController::class, 'update'])->middleware('auth')->name( 'user.update');


//--------------------Route pour la panier--------------------

Route::middleware('auth')->group(function () {
    //Afficher le panier
    Route::get('panier', [PanierController::class, 'afficherPanier'])->name('panier');
    //Ajouter un produit dans le panier
    Route::post('/panier/add/{produit}', [PanierController::class, 'add'])->name('panier.add');
    //Enlever un produit dans le panier
    Route::delete('/panier/remove/{produit}', [PanierController::class, 'remove'])->name('panier.remove');
    //Augmenter la quantité d'un produit dans le panier
    Route::post('/panier/increase/{produit}', [PanierController::class, 'increaseQuantity'])->name('panier.increase');
    //Diminuer la quantité d'un produit dans le panier
    Route::post('/panier/decrease/{produit}', [PanierController::class, 'decreaseQuantity'])->name('panier.decrease');

    //Ajouter une pièce dans le panier
    Route::post('/panier/add-piece/{piece}', [PanierController::class, 'addPiece'])->name('panier.addPiece');
    //Enlever une pièce dans le panier
    Route::delete('/panier/remove-piece/{piece}', [PanierController::class, 'removePiece'])->name('panier.removePiece');
    //Augmenter la quantité d'une pièce dans le panier
    Route::post('/panier/increase-piece/{piece}', [PanierController::class, 'increasePieceQuantity'])->name('panier.increasePiece');
    //Diminuer la quantité d'une pièce dans le panier
    Route::post('/panier/decrease-piece/{piece}', [PanierController::class, 'decreasePieceQuantity'])->name('panier.decreasePiece');

    //Ajouter une offre du jour dans le panier
    Route::post('/panier/add-offre/{idOffre}', [PanierController::class, 'ajouterOffreAuPanier'])->name('panier.ajouterOffre');
    //Enlever une offre du jour dans le panier
    Route::delete('panier/remove-offre/{idOffre}', [PanierController::class, 'removeOffre'])->name('panier.removeOffre');
    //Augmenter la quantité d'une offre du jour dans le panier
    Route::post('/panier/increase-offre-quantity/{idOffre}', [PanierController::class, 'increaseOffreQuantity'])->name('panier.increaseOffreQuantity');
    //Diminuer la quantité d'une offre du jour dans le panier
    Route::post('/panier/decrease-offre-quantity/{idOffre}', [PanierController::class, 'decreaseOffreQuantity'])->name('panier.decreaseOffreQuantity');

});

//--------------------Routes pour générer les commandes--------------------
Route::post('panier/generateInvoice', [PanierController::class, 'generateInvoice'])->name('panier.generateInvoice');

Route::post('commandes/generateInvoice/{idCommande}', [CommandeController::class, 'generateInvoice'])->name('commandes.generateInvoice');
//route admin gerer les commandes
Route::get('admin/commandes', [AdminController::class, 'commandes'])->name('admin.commandes');

//Passer la commande
Route::post('panier/passerCommande', [PanierController::class, 'passerCommande'])->name('panier.passerCommande'); 
Route::post('commandes/generateInvoice/{idCommande}', [CommandeController::class, 'generateInvoice'])->name('commandes.generateInvoice');

/*Auth pour l'ajout au panier si l'utilisateur n'est pas connecter
Route::get('/connexion', [LoginController::class, 'index'])->name('user.index');
Route::post('/connexion', [LoginController::class, 'login'])->name('user.login');
Route::get('/connexion/logout', [LogoutController::class, 'destroy'])->name('user.logout');*/




