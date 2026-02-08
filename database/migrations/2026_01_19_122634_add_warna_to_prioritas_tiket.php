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
        Schema::table('prioritas_tiket', function (Blueprint $table) {
            $table->string('warna')->nullable()->after('nama_prioritas_tiket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prioritas_tiket', function (Blueprint $table) {
            //
        });
    }
};
