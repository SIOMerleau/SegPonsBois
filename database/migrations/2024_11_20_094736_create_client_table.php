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
        Schema::create('client', function (Blueprint $table) {
            $table->id('idClient');
            $table->string('nomClient', 30)->nullable();
            $table->string('prenomClient', 30)->nullable();
            $table->string('telClient', 15)->nullable();
            $table->string('mailClient', 50)->nullable();
            $table->string('adRueClient', 30)->nullable();
            $table->string('adCPClient')->nullable();
            $table->string('adVilleClient', 30)->nullable();
            $table->string('mdpClient')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
