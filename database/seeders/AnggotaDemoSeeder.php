<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Services\KartuAnggotaService;
use Illuminate\Database\Seeder;

class AnggotaDemoSeeder extends Seeder
{
    public function run()
    {
        $kartuService = new KartuAnggotaService();
        
        $demoData = [
            [
                'nik' => '3201010101900001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'pendidikan_terakhir' => 'S1',
                'pekerjaan' => 'Karyawan Swasta/BUMN/BUMD',
                'ktp_provinsi_code' => '32',
                'ktp_provinsi_name' => 'Jawa Barat',
                'ktp_kota_code' => '3201',
                'ktp_kota_name' => 'Kabupaten Bogor',
                'ktp_kecamatan_code' => '3201010',
                'ktp_kecamatan_name' => 'Cibinong',
                'ktp_kelurahan_code' => '3201010001',
                'ktp_kelurahan_name' => 'Nanggewer',
                'ktp_rt_rw' => '001/002',
                'ktp_alamat_detail' => 'Jl. Raya Bogor No. 123',
                'domisili_provinsi_code' => '32',
                'domisili_provinsi_name' => 'Jawa Barat',
                'domisili_kota_code' => '3201',
                'domisili_kota_name' => 'Kabupaten Bogor',
                'domisili_kecamatan_code' => '3201010',
                'domisili_kecamatan_name' => 'Cibinong',
                'domisili_kelurahan_code' => '3201010001',
                'domisili_kelurahan_name' => 'Nanggewer',
                'domisili_rt_rw' => '001/002',
                'domisili_alamat_detail' => 'Jl. Raya Bogor No. 123',
                'no_wa' => '081234567890',
                'email' => 'ahmad@example.com',
                'jml_keluarga_inti' => 4,
                'jml_keluarga_serumah' => 4,
                'ketertarikan' => json_encode(['Pendidikan', 'Sosial', 'Ekonomi']),
            ],
            [
                'nik' => '3202020202900002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'tanggal_lahir' => '1990-02-02',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'pendidikan_terakhir' => 'S1',
                'pekerjaan' => 'Pegawai Negeri Sipil/PPPK',
                'ktp_provinsi_code' => '32',
                'ktp_provinsi_name' => 'Jawa Barat',
                'ktp_kota_code' => '3202',
                'ktp_kota_name' => 'Kota Bogor',
                'ktp_kecamatan_code' => '3202020',
                'ktp_kecamatan_name' => 'Bogor Tengah',
                'ktp_kelurahan_code' => '3202020001',
                'ktp_kelurahan_name' => 'Sempur',
                'ktp_rt_rw' => '003/004',
                'ktp_alamat_detail' => 'Jl. Pahlawan No. 45',
                'domisili_provinsi_code' => '32',
                'domisili_provinsi_name' => 'Jawa Barat',
                'domisili_kota_code' => '3202',
                'domisili_kota_name' => 'Kota Bogor',
                'domisili_kecamatan_code' => '3202020',
                'domisili_kecamatan_name' => 'Bogor Tengah',
                'domisili_kelurahan_code' => '3202020001',
                'domisili_kelurahan_name' => 'Sempur',
                'domisili_rt_rw' => '003/004',
                'domisili_alamat_detail' => 'Jl. Pahlawan No. 45',
                'no_wa' => '082345678901',
                'email' => 'siti@example.com',
                'jml_keluarga_inti' => 3,
                'jml_keluarga_serumah' => 3,
                'ketertarikan' => json_encode(['Lingkungan Hidup', 'Sosial', 'Pendidikan']),
            ],
        ];

        foreach ($demoData as $data) {
            // Generate nomor kartu
            $data['no_kartu'] = $kartuService->generateNoKartu($data);
            $data['registered_by'] = 1; // Super admin
            $data['registered_at'] = now();
            
            Anggota::create($data);
        }
    }
}