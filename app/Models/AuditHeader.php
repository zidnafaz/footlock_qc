<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AuditHeader extends Model
{
    protected $fillable = [
        'audit_code',
        'audit_date',
        'auditor_name',
        'department',
        'shift',
        'product_name',
        'product_code',
        'supplier_name',
        'category',
        'total_sample',
        'method',
    ];

    protected $casts = [
        'audit_date' => 'date',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(AuditDetail::class, 'audit_header_id');
    }

    public function summary(): HasOne
    {
        return $this->hasOne(AuditSummary::class, 'audit_header_id');
    }

    // Generate kode audit otomatis
    public static function generateAuditCode()
    {
        $year = date('Y');
        $lastAudit = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastAudit) {
            // Ambil 3 digit terakhir dari kode audit terakhir
            $lastNumber = intval(substr($lastAudit->audit_code, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada audit tahun ini, mulai dari 001
            $newNumber = '001';
        }

        return 'AUD-' . $year . '-' . $newNumber;
    }
}
