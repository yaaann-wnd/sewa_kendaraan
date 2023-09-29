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
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyewa');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('status_penyetuju')->nullable();
            $table->string('penyetuju_1');
            $table->string('penyetuju_2');
            $table->string('status_sewa')->default('Menunggu persetujuan atasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
