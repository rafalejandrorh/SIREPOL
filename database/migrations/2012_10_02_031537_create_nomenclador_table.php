<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomencladorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valor', 50);
            $table->unsignedInteger('tipo_id');
            $table->unsignedInteger('nomenclador_id');

            $table->foreign('tipo_id')->references('id')->on('nomenclador'); 
            $table->foreign('nomenclador_id')->references('id')->on('nomenclador'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclador');
    }
}
