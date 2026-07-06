<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->text('welcome_heading')->nullable()->after('description');
            $table->text('welcome_text')->nullable()->after('welcome_heading');
            $table->string('welcome_image')->nullable()->after('welcome_text');
            $table->json('welcome_advantages')->nullable()->after('welcome_image');
            $table->text('sambutan_text')->nullable()->after('welcome_advantages');
            $table->string('sambutan_image')->nullable()->after('sambutan_text');
            $table->string('sejarah_image1')->nullable()->after('history');
            $table->string('sejarah_image2')->nullable()->after('sejarah_image1');
        });
    }

    public function down(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->dropColumn([
                'welcome_heading',
                'welcome_text',
                'welcome_image',
                'welcome_advantages',
                'sambutan_text',
                'sambutan_image',
                'sejarah_image1',
                'sejarah_image2',
            ]);
        });
    }
};
