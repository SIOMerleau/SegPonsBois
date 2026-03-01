<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisTable extends Migration
{
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id('idAvis');
            $table->unsignedBigInteger('idProduit');
            $table->unsignedBigInteger('idUsers');
            $table->integer('etoilesAvis')->default(0);
            $table->text('texteAvis')->nullable();
            $table->timestamp('dateAvis')->nullable();
            $table->timestamps();

            $table->foreign('idProduit')->references('idProd')->on('produits')->onDelete('cascade');
            $table->foreign('idUsers')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('avis');
    }
}
?>