<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Anggota extends Model
{
    use SoftDeletes;

    protected $table = 'anggotas';

    protected $fillable = [
        'user_id',
        'no_kartu',
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'pekerjaan',
        
        // KTP
        'foto_ktp',
        'ktp_provinsi_code',
        'ktp_provinsi_name',
        'ktp_kota_code',
        'ktp_kota_name',
        'ktp_kecamatan_code',
        'ktp_kecamatan_name',
        'ktp_kelurahan_code',
        'ktp_kelurahan_name',
        'ktp_rt_rw',
        'ktp_alamat_detail',
        
        // Domisili
        'domisili_provinsi_code',
        'domisili_provinsi_name',
        'domisili_kota_code',
        'domisili_kota_name',
        'domisili_kecamatan_code',
        'domisili_kecamatan_name',
        'domisili_kelurahan_code',
        'domisili_kelurahan_name',
        'domisili_rt_rw',
        'domisili_alamat_detail',
        
        // Kontak
        'no_wa',
        'email',
        
        // Keluarga
        'jml_keluarga_inti',
        'jml_keluarga_serumah',
        
        // Ketertarikan
        'ketertarikan',
        
        'is_active',
        'registered_by',
        'registered_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'ketertarikan' => 'array',
            'is_active' => 'boolean',
            'registered_at' => 'datetime',
            'jml_keluarga_inti' => 'integer',
            'jml_keluarga_serumah' => 'integer',
        ];
    }

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Admin yang mendaftarkan
    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    // Scope untuk filter aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk umur
    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }

    // Accessor untuk format NIK
    public function getNikFormattedAttribute(): string
    {
        return substr($this->nik, 0, 4) . ' ' . 
               substr($this->nik, 4, 4) . ' ' . 
               substr($this->nik, 8, 4) . ' ' . 
               substr($this->nik, 12, 4);
    }
}