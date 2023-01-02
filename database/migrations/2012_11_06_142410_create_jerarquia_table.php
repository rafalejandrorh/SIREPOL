<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJerarquiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclador.jerarquia', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('valor', 200);
            $table->unsignedInteger('id_organismo');
            $table->timestamps();

            $table->foreign('id_organismo')->references('id')->on('nomenclador.organismos_seguridad'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclador.jerarquia');
    }
}
