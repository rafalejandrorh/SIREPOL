<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resenna_detenido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_resenna');
            $table->unsignedInteger('id_person');
            $table->unsignedInteger('id_estado_civil');
            $table->unsignedInteger('id_profesion');
            $table->unsignedInteger('id_motivo_resenna');
            $table->unsignedInteger('id_tez');
            $table->unsignedInteger('id_contextura');
            $table->unsignedInteger('id_funcionario_aprehensor');
            $table->unsignedInteger('id_funcionario_resenna');
            $table->string('direccion',100)->nullable();
            $table->string('observaciones',500)->nullable();

            $table->foreign('id_person')->references('id')->on('persons'); 
            $table->foreign('id_estado_civil')->references('id')->on('nomenclador.caracteristicas_resennado'); 
            $table->foreign('id_profesion')->references('id')->on('nomenclador.caracteristicas_resennado'); 
            $table->foreign('id_motivo_resenna')->references('id')->on('nomenclador.caracteristicas_resennado');
            $table->foreign('id_tez')->references('id')->on('nomenclador.caracteristicas_resennado');  
            $table->foreign('id_contextura')->references('id')->on('nomenclador.caracteristicas_resennado');
            $table->foreign('id_funcionario_aprehensor')->references('id')->on('funcionarios');      
            $table->foreign('id_funcionario_resenna')->references('id')->on('funcionarios');      
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
        Schema::dropIfExists('resenna_detenido');
    }
};
