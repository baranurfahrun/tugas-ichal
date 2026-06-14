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
            $table->dropColumn('status');
        });

        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->string('status')->default('pengajuan_dikirim')->after('file_ket_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak'])->default('pending')->after('file_ket_lahir');
        });
    }
};
