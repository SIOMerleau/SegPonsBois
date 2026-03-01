<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcernerTable extends Migration
{
    public function up()
    {
        Schema::create('concerner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOffre');
            $table->unsignedBigInteger('idProd_Produit');
            $table->decimal('prixOffre', 8, 2);
            $table->integer('quantiteOf');
            $table->timestamps();

            $table->foreign('idOffre')->references('idOffre')->on('offres')->onDelete('cascade');
            $table->foreign('idProd_Produit')->references('idProd')->on('produits')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('concerner');
    }
}
