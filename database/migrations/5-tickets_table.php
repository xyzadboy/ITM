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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->foreignId('pelapor_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('kategori_tiket_id')->constrained('kategori_tiket')-> onDelete('cascade');
            // $table->foreignId('prioritas_tiket_id')->constrained('prioritas_tiket')->nullable()-> onDelete('cascade');
            $table->foreignId('agent_id')->nullable()->constrained('pegawai')->onDelete('set null');
            $table->text('deskripsi');
            $table->string('status')->default('waiting for response');
            $table->integer('estimasi_waktu')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
