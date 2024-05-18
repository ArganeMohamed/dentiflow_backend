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
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('id_Ordanance');
            $table->unsignedBigInteger('id_Medecin');
            $table->unsignedBigInteger('id_Patient');
            $table->timestamps();
        });
        Schema::table('rendez_vouses', function (Blueprint $table) {
            $table->foreign('id_Ordanance')->references('id')->on('ordonances')->onDelete('cascade');
            $table->foreign('id_Medecin')->references('id')->on('medecins')->onDelete('cascade');
            $table->foreign('id_Patient')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
