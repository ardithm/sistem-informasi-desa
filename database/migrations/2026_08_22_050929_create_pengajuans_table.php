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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengjuan', 30)->unique();
            $table->foreignId('penduduk_id')
                ->constrained('penduduks')
                ->restrictOnDelete();
            $table->foreignId('layanan_id')
                ->constrained('layanans')
                ->restrictOnDelete();
            $table->string('no_hp', 20);
            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'perlu_perbaikan',
                'diproses',
                'selesai',
                'ditolak',
            ])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('diproses_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->dateTime('tanggal_diproses')
                ->nullable();
            $table->dateTime('tanggal_selesai')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
