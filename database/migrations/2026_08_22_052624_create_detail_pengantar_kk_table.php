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
        Schema::create('detail_pengantar_kk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')
                ->unique()
                ->constrained('pengajuans')
                ->cascadeOnDelete();
            $table->string('nomor_kk', 16)->nullable();
            $table->text('keperluan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengantar_kk');
    }
};
