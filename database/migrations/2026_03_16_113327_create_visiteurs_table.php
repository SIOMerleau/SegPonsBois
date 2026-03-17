<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('visiteurs', function (Blueprint $table) {
        $table->id('idVisiteur');
        $table->string('nomVisiteur');
        $table->string('prenomVisiteur');
        $table->string('telVisiteur');
        $table->string('mailVisiteur');
        $table->date('dateContact');
        $table->text('messageContact');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs');
    }
};
