<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user FIRST
        User::factory()->create([
            'name' => 'Admin SMK Alhidayah',
            'email' => 'admin@smkalhidayah.sch.id',
        ]);

        // Then run seeders that depend on it
        $this->call([
            JurusanSeeder::class,
            SchoolSettingSeeder::class,
            PartnerSeeder::class,
            KelulusanSeeder::class,
            ShieldSeeder::class,
        ]);
    }
}
