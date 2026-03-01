<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->increments('idProd');
            $table->string('designationProduit', 25);
            $table->float('prixProduit')->nullable();
            $table->integer('stockProduit')->nullable();
            $table->unsignedInteger('idCategorie');
            $table->text('descriptionProduit')->nullable();
            $table->foreign('idCategorie')->references('idCategorie')->on('categorie')->onDelete('cascade');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE produit ADD photoProduit LONGBLOB NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
}
