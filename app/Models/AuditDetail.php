<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditDetail extends Model
{
    protected $fillable = [
        'audit_header_id',
        'parameter_id',
        'value',
        'note',
    ];

    public function header(): BelongsTo
    {
        return $this->belongsTo(AuditHeader::class, 'audit_header_id');
    }

    public function parameter(): BelongsTo
    {
        return $this->belongsTo(AuditParameter::class, 'parameter_id');
    }
}
