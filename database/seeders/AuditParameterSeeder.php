<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            // Visual Aspect
            ['parameter_name' => 'Kualitas Kulit', 'sub_parameter' => 'Tekstur kulit halus dan rata', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kualitas Kulit', 'sub_parameter' => 'Tidak ada cacat permukaan (goresan, noda)', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kualitas Kulit', 'sub_parameter' => 'Warna konsisten sesuai standar', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Jahitan', 'sub_parameter' => 'Jahitan rapi dan kuat', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Jahitan', 'sub_parameter' => 'Tidak ada benang lepas', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Jahitan', 'sub_parameter' => 'Jarak jahitan konsisten', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Lem & Perekat', 'sub_parameter' => 'Tidak ada bekas lem berlebih', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Lem & Perekat', 'sub_parameter' => 'Perekatan sempurna tanpa celah', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Finishing', 'sub_parameter' => 'Permukaan bersih dari debu/kotoran', 'aspect' => 'Visual', 'is_active' => 'Yes'],
            ['parameter_name' => 'Finishing', 'sub_parameter' => 'Cat/polish merata', 'aspect' => 'Visual', 'is_active' => 'Yes'],

            // Dimensional Aspect
            ['parameter_name' => 'Ukuran Sepatu', 'sub_parameter' => 'Panjang sesuai size chart', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Ukuran Sepatu', 'sub_parameter' => 'Lebar sesuai standar', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Ukuran Sepatu', 'sub_parameter' => 'Tinggi hak sesuai spesifikasi', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Sol Sepatu', 'sub_parameter' => 'Ketebalan sol sesuai standar', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Sol Sepatu', 'sub_parameter' => 'Pola grip jelas dan dalam', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Sol Sepatu', 'sub_parameter' => 'Tidak mudah terkelupas', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Struktur & Bentuk', 'sub_parameter' => 'Simetris kiri-kanan', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Struktur & Bentuk', 'sub_parameter' => 'Tumit kokoh tidak miring', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Fungsi & Kenyamanan', 'sub_parameter' => 'Insole empuk dan fit', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],
            ['parameter_name' => 'Fungsi & Kenyamanan', 'sub_parameter' => 'Tali/velcro/zipper berfungsi baik', 'aspect' => 'Dimensional', 'is_active' => 'Yes'],

            // Packaging Aspect
            ['parameter_name' => 'Kotak Sepatu', 'sub_parameter' => 'Kotak tidak rusak/penyok', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kotak Sepatu', 'sub_parameter' => 'Desain kotak sesuai brand', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Label & Barcode', 'sub_parameter' => 'Label ukuran terpasang benar', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Label & Barcode', 'sub_parameter' => 'Barcode dapat di-scan', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Label & Barcode', 'sub_parameter' => 'Informasi produk lengkap', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kelengkapan', 'sub_parameter' => 'Kertas tissue/pembungkus ada', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kelengkapan', 'sub_parameter' => 'Silica gel/pengawet ada', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kebersihan', 'sub_parameter' => 'Kemasan bersih dari debu', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
            ['parameter_name' => 'Kebersihan', 'sub_parameter' => 'Tidak ada bau tidak sedap', 'aspect' => 'Packaging', 'is_active' => 'Yes'],
        ];

        DB::table('audit_parameters')->insert($parameters);
    }
}
