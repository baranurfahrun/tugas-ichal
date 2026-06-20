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
            $table->string('agama')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->dropColumn(['agama', 'rt', 'rw']);
        });
    }
};
