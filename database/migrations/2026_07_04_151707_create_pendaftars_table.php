<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('nama_ortu')->nullable();
            $table->string('no_telepon_ortu')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->foreignId('jurusan_id')->constrained('jurusans');
            $table->enum('status', [
                'menunggu_pembayaran',
                'menunggu_verifikasi',
                'terverifikasi',
                'diterima',
                'ditolak',
            ])->default('menunggu_pembayaran');
            $table->string('nomor_pendaftaran')->unique();
            $table->text('alasan_ditolak')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
