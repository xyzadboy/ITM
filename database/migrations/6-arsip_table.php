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
            $table->unsignedBigInteger('ticket_id');
            $table->string('no_tiket');
            $table->foreignId('pelapor_id')->nullable()->constrained('pegawai')->nullOnDelete();
            $table->foreignId('agent_id')->nullable() ->nullOnDelete();
            $table->foreignId('prioritas_id')->nullable()->constrained('prioritas_tiket')->nullOnDelete();
            $table->text('deskripsi');
            $table->string('status')->default('resolved');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};
