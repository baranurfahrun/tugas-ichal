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
        // Format existing strings into JSON arrays to prevent errors
        \Illuminate\Support\Facades\DB::table('pengajuan_kelahiran')
            ->whereNotNull('file_akta_lahir')
            ->where('file_akta_lahir', 'not like', '[%')
            ->update([
                'file_akta_lahir' => \Illuminate\Support\Facades\DB::raw("CONCAT('[\"', file_akta_lahir, '\"]')")
            ]);

        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->json('file_akta_lahir')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kelahiran', function (Blueprint $table) {
            $table->string('file_akta_lahir')->nullable()->change();
        });
    }
};
