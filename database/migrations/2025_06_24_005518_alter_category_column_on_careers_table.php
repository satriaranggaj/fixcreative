<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE careers MODIFY COLUMN category ENUM('full_time', 'part_time', 'both') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE careers MODIFY COLUMN category ENUM('full_time', 'part_time') NOT NULL");
    }
};
