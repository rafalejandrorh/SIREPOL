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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('incoming_id_user');
            $table->integer('outgoing_id_user');
            $table->string('message', 1200);
            $table->boolean('markAsRead');
            $table->timestamps();

            $table->foreign('incoming_id_user')->references('id')->on('users'); 
            $table->foreign('outgoing_id_user')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
