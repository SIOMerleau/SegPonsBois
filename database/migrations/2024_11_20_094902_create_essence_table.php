<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essence', function (Blueprint $table) {
            $table->increments('idEssence');
            $table->text('varieteEssence')->nullable();
            $table->string('typeEssence', 15)->nullable();
            $table->string('nomLatinEssence', 30)->nullable();
            $table->string('origineEssence', 20)->nullable();
            $table->string('densiteEssence', 15)->nullable();
            $table->string('durabiliteEssence', 15)->nullable();
            $table->text('commentaireEssence')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE essence ADD photoEssence LONGBLOB NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('essence');
    }
}
