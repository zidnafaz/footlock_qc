<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditParameter extends Model
{
    protected $fillable = [
        'parameter_name',
        'sub_parameter',
        'aspect',
        'is_active',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(AuditDetail::class, 'parameter_id');
    }

    // Scope untuk parameter aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', 'Yes');
    }

    // Scope untuk filter by aspect
    public function scopeByAspect($query, $aspect)
    {
        return $query->where('aspect', $aspect);
    }
}
