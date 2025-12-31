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
    Schema::create('rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kerusakan_id')->constrained('kerusakans')->cascadeOnDelete();
        $table->json('gejala_ids'); // simpan ID gejala
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('rules');
}

};
