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
        Schema::table('aktas', function (Blueprint $table) {
            $table->string('file_akta')->nullable()->after('tgl_terbit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktas', function (Blueprint $table) {
            $table->dropColumn('file_akta');
        });
    }
};
