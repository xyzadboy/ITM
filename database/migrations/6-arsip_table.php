<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();

            // relasi ke ticket (TIDAK cascade)
            $table->unsignedBigInteger('ticket_id');
            // snapshot nomor tiket
            $table->string('no_tiket');

            // pelapor
            $table->foreignId('pelapor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // agent
            $table->foreignId('agent_id')
                ->nullable()
                ->constrained('pegawai')
                ->nullOnDelete();

            // kategori tiket
            $table->foreignId('kategori_tiket_id')
                ->nullable()
                ->constrained('kategori_tiket')
                ->nullOnDelete();

            // snapshot deskripsi
            $table->text('deskripsi');
            $table->string('status')->default('resolved');

            // waktu resolve
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};
