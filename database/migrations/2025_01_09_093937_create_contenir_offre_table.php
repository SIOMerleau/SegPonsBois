<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contenir_offre', function (Blueprint $table) {
            $table->unsignedBigInteger('idPanier');
            $table->unsignedBigInteger('idOffre');
            $table->integer('quantiteOf')->default(1);
            $table->decimal('prixOffre', 8, 2);
            $table->foreign('idPanier')->references('id')->on('paniers')->onDelete('cascade');
            $table->foreign('idOffre')->references('id')->on('offres')->onDelete('cascade');
            $table->primary(['idPanier', 'idOffre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenir_offre');
    }
};
