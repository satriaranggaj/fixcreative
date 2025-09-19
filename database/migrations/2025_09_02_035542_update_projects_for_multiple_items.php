<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hapus kolom item, qty, price dari projects
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'item')) {
                $table->dropColumn('item');
            }
            if (Schema::hasColumn('projects', 'qty')) {
                $table->dropColumn('qty');
            }
            if (Schema::hasColumn('projects', 'price')) {
                $table->dropColumn('price');
            }
        });

        // 2. Buat tabel project_items
        Schema::create('project_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('name'); // nama item
            $table->integer('qty')->default(1);
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // rollback: tambahkan kembali kolom ke projects
        Schema::table('projects', function (Blueprint $table) {
            $table->string('item')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('price', 15, 2)->nullable();
        });

        Schema::dropIfExists('project_items');
    }
};
