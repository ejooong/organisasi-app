<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahCache extends Model
{
    protected $table = 'wilayah_cache';

    protected $fillable = [
        'type',
        'code',
        'parent_code',
        'name',
        'meta_data',
        'cached_at',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'cached_at' => 'datetime',
    ];

    // Scope
    public function scopeProvince($query)
    {
        return $query->where('type', 'province');
    }

    public function scopeRegency($query)
    {
        return $query->where('type', 'regency');
    }

    public function scopeDistrict($query)
    {
        return $query->where('type', 'district');
    }

    public function scopeVillage($query)
    {
        return $query->where('type', 'village');
    }

    public function scopeByParent($query, $parentCode)
    {
        return $query->where('parent_code', $parentCode);
    }
}