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
        Schema::create('pengajuan_kelahiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faskes_id')->constrained('faskes');
            $table->foreignId('user_id')->constrained('users'); // Petugas yang input
            
            // Data Bayi
            $table->string('nama_bayi');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tgl_lahir');
            $table->time('jam_lahir');
            $table->integer('berat_bayi');
            
            // Data Orang Tua
            $table->string('nama_ibu');
            $table->string('nik_ibu', 16);
            $table->string('nama_ayah');
            $table->string('nik_ayah', 16);
            
            // Status & Berkas
            $table->string('file_ket_lahir')->nullable();
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak'])->default('pending');
            $table->text('keterangan_status')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kelahiran');
    }
};
