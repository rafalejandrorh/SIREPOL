<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('credencial')->unique()->nullable();
            $table->unsignedInteger('id_jerarquia')->nullable();
            $table->string('telefono', 50)->nullable();
            $table->unsignedInteger('id_person');
            $table->unsignedInteger('id_estatus');
            $table->unsignedInteger('id_organismo');

            $table->foreign('id_person')->references('id')->on('persons'); 
            $table->foreign('id_jerarquia')->references('id')->on('nomenclador.jerarquia'); 
            $table->foreign('id_estatus')->references('id')->on('nomenclador.estatus_funcionario'); 
            $table->foreign('id_organismo')->references('id')->on('nomenclador.organismos_seguridad');
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
        Schema::dropIfExists('funcionarios');
    }
}
