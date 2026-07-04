<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelulusans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_ujian')->unique();
            $table->string('nama');
            $table->enum('hasil', ['lulus', 'tidak_lulus']);
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelulusans');
    }
};
