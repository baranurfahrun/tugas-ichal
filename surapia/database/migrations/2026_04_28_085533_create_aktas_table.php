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
        Schema::create('aktas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_kelahiran_id')->constrained('pengajuan_kelahiran')->onDelete('cascade');
            $table->string('no_akta')->unique();
            $table->date('tgl_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktas');
    }
};
