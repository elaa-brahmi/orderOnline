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
        Schema::table('commande', function (Blueprint $table) {
            $table->unsignedBigInteger('idclient')->after('idcommande'); // Add the idclient column

            // Define foreign key constraint
            $table->foreign('idclient')->references('idclient')->on('client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->dropForeign(['idclient']);

            // Then drop the column
            $table->dropColumn('idclient');
        });
    }
};
