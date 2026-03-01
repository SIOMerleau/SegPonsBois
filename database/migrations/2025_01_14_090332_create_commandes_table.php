<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id('idCommande');
            $table->unsignedBigInteger('idClient');
            $table->decimal('total_price', 8, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('idClient')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCommande');
            $table->unsignedBigInteger('idProduit');
            $table->integer('quantitePr');
            $table->decimal('prixPr', 8, 2);

            $table->foreign('idCommande')->references('idCommande')->on('commandes')->onDelete('cascade');
            $table->foreign('idProduit')->references('idProd')->on('produits')->onDelete('cascade');
        });

        Schema::create('commande_piece', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCommande');
            $table->unsignedBigInteger('idPiece');
            $table->integer('quantitePc');
            $table->decimal('prixPc', 8, 2);

            $table->foreign('idCommande')->references('idCommande')->on('commandes')->onDelete('cascade');
            $table->foreign('idPiece')->references('idPiece')->on('pieces')->onDelete('cascade');
        });

        Schema::create('commande_offre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCommande');
            $table->unsignedBigInteger('idOffre');
            $table->integer('quantiteOf');
            $table->decimal('prixOffre', 8, 2);

            $table->foreign('idCommande')->references('idCommande')->on('commandes')->onDelete('cascade');
            $table->foreign('idOffre')->references('idOffre')->on('offres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_offre');
        Schema::dropIfExists('commande_piece');
        Schema::dropIfExists('commande_produit');
        Schema::dropIfExists('commandes');
    }
}
