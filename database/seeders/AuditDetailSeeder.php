<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $details = [];
        $values = ['OK', 'NG', 'OK', 'OK', 'NG', 'OK', 'OK', 'OK'];
        $notes = [
            null,
            'Jahitan tidak rapi pada bagian samping',
            null,
            null,
            'Warna sedikit belang',
            null,
            null,
            'Sedikit bekas lem di bagian dalam',
        ];

        // Untuk setiap audit header (5 audit)
        for ($auditId = 1; $auditId <= 5; $auditId++) {
            // Ambil 10 parameter random untuk setiap audit
            $parameterIds = range(1, 29);
            shuffle($parameterIds);
            $selectedParams = array_slice($parameterIds, 0, 10);

            foreach ($selectedParams as $index => $parameterId) {
                $valueIndex = $index % count($values);
                $details[] = [
                    'audit_header_id' => $auditId,
                    'parameter_id' => $parameterId,
                    'value' => $values[$valueIndex],
                    'note' => $values[$valueIndex] === 'NG' ? $notes[$valueIndex] : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('audit_details')->insert($details);
    }
}
