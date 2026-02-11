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
        Schema::create('prioritas_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prioritas_tiket');
            $table->foreignId('departemen_id')->constrained('departemen')->onDelete('cascade');
            $table->string('level_prioritas');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prioritas_tiket');
    }
};
