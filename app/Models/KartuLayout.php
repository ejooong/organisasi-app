<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuLayout extends Model
{
    protected $fillable = [
        'nama_layout',
        'file_path',
        'file_path_depan',
        'tipe_file',
        'field_positions',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'field_positions' => 'array',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}