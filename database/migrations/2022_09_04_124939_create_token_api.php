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
        Schema::create('token_api', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unique();
            $table->string('token', 350);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('expires_at');
            $table->timestamp('updated_at');
            $table->boolean('estatus');

            $table->foreign('id_user')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_api');
    }
};
