<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePieceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piece', function (Blueprint $table) {
            $table->increments('idPiece');
            $table->string('typePiece', 15)->default('Carrelet');
            $table->text('commentaire')->nullable();
            $table->string('referencePiece', 255)->nullable();
            $table->float('prixHTPiece')->nullable();
            $table->integer('stockPiece')->nullable();
            $table->boolean('exportablePiece')->nullable();
            $table->unsignedInteger('idEssence');
            $table->foreign('idEssence')->references('idEssence')->on('essence');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE piece ADD photoPiece LONGBLOB NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piece');
    }
}
