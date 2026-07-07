<?php

namespace App\Services;

use App\Models\Anggota;
use Illuminate\Support\Carbon;

class KartuAnggotaService
{
    /**
     * Generate nomor kartu anggota
     */
    public function generateNoKartu(array $data): string
    {
        // Bulan lahir (2 digit)
        $tanggalLahir = Carbon::parse($data['tanggal_lahir']);
        $bulanLahir = $tanggalLahir->format('m');
        
        // Tahun lahir (2 digit terakhir)
        $tahunLahir = $tanggalLahir->format('y');
        
        // Jenis kelamin
        $jk = $data['jenis_kelamin'] === 'L' ? '11' : '12';
        
        // Tahun pendaftaran (2 digit terakhir)
        $tahunDaftar = date('y');
        
        // Kode provinsi dari domisili (2 digit)
        // Pastikan hanya ambil angka
        $provCode = str_pad(substr($data['domisili_provinsi_code'], 0, 2), 2, '0', STR_PAD_LEFT);
        
        // Kode kota dari domisili (ambil 2 digit terakhir misal 32.01 jadi 01)
        $kotaParts = explode('.', $data['domisili_kota_code']);
        $kotaCode = str_pad(end($kotaParts), 2, '0', STR_PAD_LEFT);
        
        // Nomor urut (4 digit)
        $urut = $this->generateUrutan($provCode, $kotaCode);
        
        // Gabungkan (16 digit)
        $noKartu = $bulanLahir . $jk . $tahunDaftar . $tahunLahir . $provCode . $kotaCode . $urut;
        
        // Pastikan unique
        while (Anggota::withTrashed()->where('no_kartu', $noKartu)->exists()) {
            $urut = str_pad((int)$urut + 1, 4, '0', STR_PAD_LEFT);
            $noKartu = $bulanLahir . $jk . $tahunDaftar . $tahunLahir . $provCode . $kotaCode . $urut;
        }
        
        return $noKartu;
    }
    
    protected function generateUrutan(string $provCode, string $kotaCode): string
    {
        // Hitung total anggota secara global agar nomor urut selalu bertambah (0001, 0002, dst)
        // terlepas dari provinsi/kota mana anggota tersebut berada.
        $count = Anggota::withTrashed()->count();
        
        return str_pad((string)($count + 1), 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Validasi format nomor kartu
     */
    public function validateNoKartu(string $noKartu): bool
    {
        $pattern = '/^\d{16}$/';
        
        if (!preg_match($pattern, $noKartu)) {
            return false;
        }
        
        $bulan = (int) substr($noKartu, 0, 2);
        if ($bulan < 1 || $bulan > 12) {
            return false;
        }
        
        $jk = substr($noKartu, 2, 2);
        if (!in_array($jk, ['11', '12'])) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Decode nomor kartu
     */
    public function decodeNoKartu(string $noKartu): array
    {
        return [
            'bulan_lahir' => substr($noKartu, 0, 2),
            'jenis_kelamin' => substr($noKartu, 2, 2) === '11' ? 'Laki-laki' : 'Perempuan',
            'tahun_daftar' => '20' . substr($noKartu, 4, 2),
            'tahun_lahir' => '19' . substr($noKartu, 6, 2), // asumsi 19xx atau 20xx
            'kode_provinsi' => substr($noKartu, 8, 2),
            'kode_kota' => substr($noKartu, 10, 2),
            'nomor_urut' => substr($noKartu, 12, 4),
        ];
    }
}