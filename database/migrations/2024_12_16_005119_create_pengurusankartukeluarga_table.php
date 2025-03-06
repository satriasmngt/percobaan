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
        Schema::create('pengurusankartukeluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique(); // Referensi dari tabel 'penduduk'
            $table->string('nama'); // Referensi dari tabel 'penduduk'
            $table->date('tanggal_pengurusan');
            $table->string('status')->default('pending'); // Status pengurusan
            $table->string('dokumen')->nullable(); // Lokasi file dokumen
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurusankartukeluarga');
    }
};
