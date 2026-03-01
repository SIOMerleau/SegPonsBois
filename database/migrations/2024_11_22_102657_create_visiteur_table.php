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
        Schema::create('visiteur', function (Blueprint $table) {
            $table->id('idVisiteur');  
            $table->string('nomVisiteur', 30);
            $table->string('prenomVisiteur', 30);
            $table->string('telVisiteur', 15)->nullable();
            $table->string('mailVisiteur', 40)->nullable();
            $table->date('dateContact')->nullable();
            $table->text('messageContact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteur');
    }
};
