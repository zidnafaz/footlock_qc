<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditSummary extends Model
{
    protected $table = 'audit_summary';

    protected $fillable = [
        'audit_header_id',
        'total_defects',
        'defect_percentage',
        'conclusion',
        'corrective_action',
        'responsible_person',
        'followup_status',
        'followup_due_date',
    ];

    protected $casts = [
        'defect_percentage' => 'decimal:2',
        'followup_due_date' => 'date',
    ];

    public function header(): BelongsTo
    {
        return $this->belongsTo(AuditHeader::class, 'audit_header_id');
    }
}
