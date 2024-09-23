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
        Schema::create('table_client', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("lastname");
            $table->string("phone");
            $table->string("adress");
            $table->string("zipcode");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_client');
    }
};
