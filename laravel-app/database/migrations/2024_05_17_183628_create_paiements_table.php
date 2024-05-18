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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->string('mode');
            $table->date('date');
            $table->unsignedBigInteger('id_Facture');
            $table->timestamps();
        });
        Schema::table('paiements', function (Blueprint $table) {
            $table->foreign('id_Facture')->references('id')->on('factures')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};
