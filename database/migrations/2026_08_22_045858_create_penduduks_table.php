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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status_perkawinan', [
                'belum_kawin',
                'kawin',
                'cerai_hidup',
                'cerai_mati'
            ]);
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->enum('status_penduduk', [
                'aktif',
                'tidak_aktif',
            ])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
