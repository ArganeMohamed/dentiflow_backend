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
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            $table->string('dent')->nullable();
            $table->text('description');
            $table->double('cout');
            $table->unsignedBigInteger('id_Devis');
            $table->unsignedBigInteger('id_Facture');
            $table->unsignedBigInteger('id_Ordanance');
            $table->timestamps();
        });
        Schema::table('traitements', function (Blueprint $table) {
            $table->foreign('id_Devis')->references('id')->on('devis')->onDelete('cascade');
            $table->foreign('id_Facture')->references('id')->on('factures')->onDelete('cascade');
            $table->foreign('id_Ordanance')->references('id')->on('ordonances')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traitements');
    }
};
