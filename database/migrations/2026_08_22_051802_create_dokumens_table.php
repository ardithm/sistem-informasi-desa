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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')
                ->constrained('pengajuans')
                ->cascadeOnDelete();
            $table->string('jenis_dokumen', 100);
            $table->string('nama_file', 255);
            $table->string('path_file', 500);
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('ukuran_file');
            $table->enum('staus_verifikasi', [
                'menunggu',
                'valid',
                'tidak_valid',
                'ditolak',
            ])->default('menunggu');
            $table->text('catatan')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
