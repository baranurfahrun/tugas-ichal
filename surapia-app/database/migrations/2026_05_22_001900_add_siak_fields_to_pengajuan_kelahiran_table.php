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
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->string('nik_bayi', 16)->nullable()->after('user_id');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->string('tempat_dilahirkan')->nullable()->after('tempat_lahir');
            $table->integer('kelahiran_ke')->nullable()->after('jam_lahir');
            $table->string('jenis_kelahiran')->nullable()->after('kelahiran_ke');
            $table->string('penolong_kelahiran')->nullable()->after('jenis_kelahiran');
            $table->integer('panjang_bayi')->nullable()->after('berat_bayi');
            $table->string('no_kk', 16)->nullable()->after('nik_ayah');
            $table->string('nama_kepala_keluarga')->nullable()->after('no_kk');
            $table->string('provinsi')->nullable()->after('nama_kepala_keluarga');
            $table->string('kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->string('kelurahan')->nullable()->after('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->dropColumn([
                'nik_bayi',
                'tempat_lahir',
                'tempat_dilahirkan',
                'kelahiran_ke',
                'jenis_kelahiran',
                'penolong_kelahiran',
                'panjang_bayi',
                'no_kk',
                'nama_kepala_keluarga',
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan'
            ]);
        });
    }
};
