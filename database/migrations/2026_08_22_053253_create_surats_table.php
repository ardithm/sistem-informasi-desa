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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')
                ->unique()
                ->constrained('pengajuans')
                ->cascadeOnDelete();
            $table->string('nomor_surat', 50)->unique();
            $table->date('tanggal_terbit');
            $table->string('file_pdf', 255);
            $table->foreignId('diterbitkan_oleh')
                ->constrained('users')
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
