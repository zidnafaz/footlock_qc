<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headers = [
            [
                'audit_code' => 'AUD-2025-001',
                'audit_date' => '2025-01-15',
                'auditor_name' => 'Budi Santoso',
                'department' => 'Cutting',
                'shift' => 'Shift 1',
                'product_name' => 'Sepatu Formal Pria Oxford',
                'product_code' => 'SFP-001-BLK',
                'supplier_name' => 'PT Kulit Jaya Abadi',
                'category' => 'Rutin',
                'total_sample' => 100,
                'method' => 'Visual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_code' => 'AUD-2025-002',
                'audit_date' => '2025-01-20',
                'auditor_name' => 'Siti Nurhaliza',
                'department' => 'Stitching',
                'shift' => 'Shift 2',
                'product_name' => 'Sepatu Sneakers Wanita',
                'product_code' => 'SNK-002-WHT',
                'supplier_name' => 'CV Karya Mandiri',
                'category' => 'Pre-shipment',
                'total_sample' => 150,
                'method' => 'Dimensional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_code' => 'AUD-2025-003',
                'audit_date' => '2025-02-05',
                'auditor_name' => 'Ahmad Fauzi',
                'department' => 'Assembling',
                'shift' => 'Shift 1',
                'product_name' => 'Sepatu Safety Boot',
                'product_code' => 'SFT-003-BRN',
                'supplier_name' => 'PT Sejahtera Makmur',
                'category' => 'Penerimaan Supplier',
                'total_sample' => 80,
                'method' => 'Fungsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_code' => 'AUD-2025-004',
                'audit_date' => '2025-02-10',
                'auditor_name' => 'Dewi Kartika',
                'department' => 'Finishing',
                'shift' => 'Shift 3',
                'product_name' => 'Sepatu Casual Slip On',
                'product_code' => 'CSL-004-NVY',
                'supplier_name' => 'PT Kulit Jaya Abadi',
                'category' => 'Rutin',
                'total_sample' => 120,
                'method' => 'Sampling',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_code' => 'AUD-2025-005',
                'audit_date' => '2025-02-15',
                'auditor_name' => 'Rizki Pratama',
                'department' => 'Cutting',
                'shift' => 'Shift 2',
                'product_name' => 'Sepatu Boots Wanita',
                'product_code' => 'BTW-005-BLK',
                'supplier_name' => 'CV Karya Mandiri',
                'category' => 'Pre-shipment',
                'total_sample' => 90,
                'method' => 'Visual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('audit_headers')->insert($headers);
    }
}
