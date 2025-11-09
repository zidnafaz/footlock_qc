<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seed Audit Tables
        $this->call([
            AuditParameterSeeder::class,  // Harus pertama karena dipakai sebagai master
            AuditHeaderSeeder::class,     // Kedua karena detail dan summary butuh header_id
            AuditDetailSeeder::class,     // Ketiga setelah header dan parameter
            AuditSummarySeeder::class,    // Terakhir setelah header ada
        ]);
    }
}
