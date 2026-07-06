<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->string('hero_thumbnail')->nullable()->after('ikon');
            $table->string('gambar_1')->nullable()->after('hero_thumbnail');
            $table->string('gambar_2')->nullable()->after('gambar_1');
        });
    }

    public function down(): void
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropColumn(['hero_thumbnail', 'gambar_1', 'gambar_2']);
        });
    }
};
