<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $summaries = [
            [
                'audit_header_id' => 1,
                'total_defects' => 3,
                'defect_percentage' => 3.00,
                'conclusion' => 'Lulus',
                'corrective_action' => 'Pelatihan ulang operator jahit untuk meningkatkan kerapian jahitan',
                'responsible_person' => 'Supervisor Stitching - Hendra Wijaya',
                'followup_status' => 'Selesai',
                'followup_due_date' => '2025-01-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_header_id' => 2,
                'total_defects' => 8,
                'defect_percentage' => 5.33,
                'conclusion' => 'Lulus',
                'corrective_action' => 'Inspeksi lebih ketat pada proses cutting dan pengecekan warna bahan baku',
                'responsible_person' => 'QC Leader - Rina Kusuma',
                'followup_status' => 'Proses',
                'followup_due_date' => '2025-02-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_header_id' => 3,
                'total_defects' => 12,
                'defect_percentage' => 15.00,
                'conclusion' => 'Tidak Lulus',
                'corrective_action' => 'Rework pada 12 unit yang cacat. Review proses perekatan sol dan evaluasi kualitas lem yang digunakan',
                'responsible_person' => 'Production Manager - Bambang Sutrisno',
                'followup_status' => 'Proses',
                'followup_due_date' => '2025-02-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_header_id' => 4,
                'total_defects' => 5,
                'defect_percentage' => 4.17,
                'conclusion' => 'Lulus',
                'corrective_action' => 'Pembersihan area kerja lebih intensif dan perbaikan SOP finishing',
                'responsible_person' => 'Supervisor Finishing - Agus Setiawan',
                'followup_status' => 'Belum',
                'followup_due_date' => '2025-02-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'audit_header_id' => 5,
                'total_defects' => 2,
                'defect_percentage' => 2.22,
                'conclusion' => 'Lulus',
                'corrective_action' => 'Pengecekan minor pada label dan packaging. Tidak ada tindakan korektif major diperlukan',
                'responsible_person' => 'Team Leader Packaging - Sari Indah',
                'followup_status' => 'Selesai',
                'followup_due_date' => '2025-02-18',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('audit_summary')->insert($summaries);
    }
}
