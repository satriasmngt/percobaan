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
        Schema::create('pengurusanktp', function (Blueprint $table) {
            $table->id();
            // Pastikan kolom 'penduduk_nik' dibuat terlebih dahulu
            $table->string('penduduk_nik')->nullable();
            $table->date('tanggal_pengurusan');
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('penduduk_nik')->references('nik')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurusanktp');
        Schema::table('pengurusanktp', function (Blueprint $table) {
            $table->dropForeign(['penduduk_nik']);
        });
    }
};