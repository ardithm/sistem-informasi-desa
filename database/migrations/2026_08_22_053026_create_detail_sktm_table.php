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
        Schema::create('detail_sktm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')
                ->unique()
                ->constrained('pengajuans')
                ->cascadeOnDelete();
            $table->unsignedInteger('jumlah_anggota_keluarga');
            $table->decimal('penghasilan_per_bulan', 15, 2);
            $table->text('keperluan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sktm');
    }
};
