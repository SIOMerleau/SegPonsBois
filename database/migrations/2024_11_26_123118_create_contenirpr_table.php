<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenirPrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenirpr', function (Blueprint $table) {
            $table->integer('quantitePr')->nullable();
            $table->float('prixPr')->nullable();
            $table->unsignedInteger('idProd_Produit');
            $table->unsignedInteger('idPanier');
            $table->primary(['idProd_Produit', 'idPanier']);
            $table->foreign('idPanier')->references('idPanier')->on('panier')->onDelete('cascade');
            $table->foreign('idProd_Produit')->references('idProd')->on('produit')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenirpr');
    }
}
