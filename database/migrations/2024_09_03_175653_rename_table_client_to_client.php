<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the `client` table exists before renaming
        if (Schema::hasTable('table_client') && !Schema::hasTable('client')) {
            Schema::rename('table_client', 'client');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the `client` table exists before renaming
        if (Schema::hasTable('client') && !Schema::hasTable('table_client')) {
            Schema::rename('client', 'table_client');
        }
    }
};
