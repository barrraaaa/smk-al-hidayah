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
        $this->call([
            JurusanSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin SMK Alhidayah',
            'email' => 'admin@smkalhidayah.sch.id',
        ]);
    }
}
