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
            $table->string('nama_saksi_1')->nullable();
            $table->string('nik_saksi_1', 16)->nullable();
            $table->string('nama_saksi_2')->nullable();
            $table->string('nik_saksi_2', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->dropColumn(['nama_saksi_1', 'nik_saksi_1', 'nama_saksi_2', 'nik_saksi_2']);
        });
    }
};
