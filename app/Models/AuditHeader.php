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
}
