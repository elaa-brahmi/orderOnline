<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ligne_commande', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idfood');
           $table->float('price');
           $table->integer('quantity');
           $table->foreign('idfood')->references('idfood')->on('food');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commande');
    }
};
