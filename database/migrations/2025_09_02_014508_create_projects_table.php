<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel utama projects (invoice)
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('venue')->nullable();
            $table->string('address')->nullable();
            $table->string('item');
            $table->integer('qty')->default(1);
            $table->decimal('price', 15, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['down_payment', 'installment', 'final'])->default('installment');
            $table->date('payment_date')->nullable();
            $table->string('method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('projects');
    }
};
