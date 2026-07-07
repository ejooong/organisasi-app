<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Services\KartuAnggotaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{
    protected KartuAnggotaService $kartuService;
    
    public function __construct(KartuAnggotaService $kartuService)
    {
        $this->kartuService = $kartuService;
        // HAPUS BARIS INI: $this->middleware(['auth', 'role:admin|super_admin']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.anggota.index');
    }
    
    /**
     * DataTable server-side
     */
    public function dataTable()
    {
        $query = Anggota::with('registeredBy')->select('anggotas.*');
        
        // Filter status
        $status = request('status', '1');
        if ($status !== 'all' && $status !== '') {
            $query->where('is_active', (bool)(int)$status);
        }
        
        // Filter provinsi
        if ($provinsi = request('provinsi')) {
            $query->where('ktp_provinsi_code', $provinsi);
        }
        
        // Filter pekerjaan
        if ($pekerjaan = request('pekerjaan')) {
            $query->where('pekerjaan', $pekerjaan);
        }
        
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($anggota) {
                try {
                    return view('admin.anggota.actions', compact('anggota'))->render();
                } catch (\Exception $e) {
                    return '<span class="text-danger">Error</span>';
                }
            })
            ->editColumn('jenis_kelamin', function ($anggota) {
                return $anggota->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('tanggal_lahir', function ($anggota) {
                return $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d/m/Y') : '-';
            })
            ->addColumn('umur', function ($anggota) {
                return $anggota->umur ?? '-';
            })
            ->addColumn('status', function ($anggota) {
                return $anggota->is_active 
                    ? '<span class="badge bg-success">Aktif</span>' 
                    : '<span class="badge bg-danger">Non-Aktif</span>';
            })
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->where('nama_lengkap', 'like', "%{$keyword}%");
            })
            ->rawColumns(['action', 'status'])
            ->make(true);

    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.anggota.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request): JsonResponse
{
    // Validasi input
    $validated = $request->validate([
        'nik' => 'required|string|size:16|unique:anggotas,nik',
        'nama_lengkap' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date|before:today',
        'jenis_kelamin' => 'required|in:L,P',
        'agama' => 'required|string',
        'pendidikan_terakhir' => 'required|string',
        'pekerjaan' => 'required|string',
        
        // Alamat KTP - hanya kode (nama diambil dari select option text)
        'ktp_provinsi_code' => 'required|string',
        'ktp_kota_code' => 'required|string',
        'ktp_kecamatan_code' => 'required|string',
        'ktp_kelurahan_code' => 'required|string',
        'ktp_rt_rw' => 'nullable|string|max:10',
        'ktp_alamat_detail' => 'required|string',
        
        // Alamat Domisili - hanya kode
        'domisili_provinsi_code' => 'required|string',
        'domisili_kota_code' => 'required|string',
        'domisili_kecamatan_code' => 'required|string',
        'domisili_kelurahan_code' => 'required|string',
        'domisili_rt_rw' => 'nullable|string|max:10',
        'domisili_alamat_detail' => 'required|string',
        
        'no_wa' => 'required|string|max:15',
        'email' => 'nullable|email|max:255',
        'jml_keluarga_inti' => 'required|integer|min:0',
        'jml_keluarga_serumah' => 'required|integer|min:0',
        'ketertarikan' => 'nullable|array',
    ]);
    
    try {
        // Ambil nama dari hidden input yang dikirim oleh frontend
        $validated['ktp_provinsi_name'] = $request->input('ktp_provinsi_name') ?: $validated['ktp_provinsi_code'];
        $validated['ktp_kota_name'] = $request->input('ktp_kota_name') ?: $validated['ktp_kota_code'];
        $validated['ktp_kecamatan_name'] = $request->input('ktp_kecamatan_name') ?: $validated['ktp_kecamatan_code'];
        $validated['ktp_kelurahan_name'] = $request->input('ktp_kelurahan_name') ?: $validated['ktp_kelurahan_code'];
        
        $validated['domisili_provinsi_name'] = $request->input('domisili_provinsi_name') ?: $validated['domisili_provinsi_code'];
        $validated['domisili_kota_name'] = $request->input('domisili_kota_name') ?: $validated['domisili_kota_code'];
        $validated['domisili_kecamatan_name'] = $request->input('domisili_kecamatan_name') ?: $validated['domisili_kecamatan_code'];
        $validated['domisili_kelurahan_name'] = $request->input('domisili_kelurahan_name') ?: $validated['domisili_kelurahan_code'];
        
        // Generate nomor kartu
        $noKartu = $this->kartuService->generateNoKartu($validated);
        
        // Tambah data tambahan
        $validated['no_kartu'] = $noKartu;
        $validated['registered_by'] = auth()->id();
        $validated['registered_at'] = now();
        
        // Konversi ketertarikan ke JSON jika ada
        if (isset($validated['ketertarikan']) && is_array($validated['ketertarikan'])) {
            $validated['ketertarikan'] = json_encode($validated['ketertarikan']);
        }
        
        // Simpan anggota
        $anggota = Anggota::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil didaftarkan dengan No. Kartu: ' . $anggota->no_kartu,
            'data' => [
                'id' => $anggota->id,
                'no_kartu' => $anggota->no_kartu,
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}
    /**
 * Helper untuk mengambil teks dari select option yang dipilih
 */
private function getSelectedText($selectId): string
{
    // Karena kita tidak bisa akses DOM dari server,
    // kita gunakan cara alternatif: query ke cache atau database wilayah
    
    // Untuk sementara, kita gunakan kode sebagai nama
    // Nanti bisa diganti dengan query ke tabel wilayah_cache
    $code = request()->input(str_replace('_name', '_code', $selectId));
    
    // Coba ambil dari wilayah_cache
    $cache = \App\Models\WilayahCache::where('code', $code)->first();
    if ($cache) {
        return $cache->name;
    }
    
    // Fallback: gunakan kode sebagai nama
    return $code ?? 'Unknown';
}
    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $anggota = Anggota::with('registeredBy')->findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $anggota = Anggota::findOrFail($id);
        
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:anggotas,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'pekerjaan' => 'required|string',
            
            // Alamat KTP
            'ktp_provinsi_code' => 'required|string',
            'ktp_kota_code' => 'required|string',
            'ktp_kecamatan_code' => 'required|string',
            'ktp_kelurahan_code' => 'required|string',
            'ktp_rt_rw' => 'nullable|string|max:10',
            'ktp_alamat_detail' => 'required|string',
            
            // Alamat Domisili
            'domisili_provinsi_code' => 'required|string',
            'domisili_kota_code' => 'required|string',
            'domisili_kecamatan_code' => 'required|string',
            'domisili_kelurahan_code' => 'required|string',
            'domisili_rt_rw' => 'nullable|string|max:10',
            'domisili_alamat_detail' => 'required|string',
            
            'no_wa' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'jml_keluarga_inti' => 'required|integer|min:0',
            'jml_keluarga_serumah' => 'required|integer|min:0',
            'ketertarikan' => 'nullable|array',
            'is_active' => 'boolean',
        ]);
        
        $validated['ktp_provinsi_name'] = $request->input('ktp_provinsi_name') ?: $validated['ktp_provinsi_code'];
        $validated['ktp_kota_name'] = $request->input('ktp_kota_name') ?: $validated['ktp_kota_code'];
        $validated['ktp_kecamatan_name'] = $request->input('ktp_kecamatan_name') ?: $validated['ktp_kecamatan_code'];
        $validated['ktp_kelurahan_name'] = $request->input('ktp_kelurahan_name') ?: $validated['ktp_kelurahan_code'];
        
        $validated['domisili_provinsi_name'] = $request->input('domisili_provinsi_name') ?: $validated['domisili_provinsi_code'];
        $validated['domisili_kota_name'] = $request->input('domisili_kota_name') ?: $validated['domisili_kota_code'];
        $validated['domisili_kecamatan_name'] = $request->input('domisili_kecamatan_name') ?: $validated['domisili_kecamatan_code'];
        $validated['domisili_kelurahan_name'] = $request->input('domisili_kelurahan_name') ?: $validated['domisili_kelurahan_code'];
        
        $anggota->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil diperbarui',
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete(); // Soft delete
        
        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus',
        ]);
    }
    
    /**
     * Export template Excel untuk import anggota
     */
    public function export()
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template_import_anggota.xls"',
        ];
        
        $columns = [
            'nik', 'nama_lengkap', 'tanggal_lahir', 'jenis_kelamin', 'agama',
            'pendidikan_terakhir', 'pekerjaan',
            'ktp_provinsi_code', 'ktp_provinsi_name', 'ktp_kota_code', 'ktp_kota_name',
            'ktp_kecamatan_code', 'ktp_kecamatan_name', 'ktp_kelurahan_code', 'ktp_kelurahan_name',
            'ktp_rt_rw', 'ktp_alamat_detail',
            'domisili_provinsi_code', 'domisili_provinsi_name', 'domisili_kota_code', 'domisili_kota_name',
            'domisili_kecamatan_code', 'domisili_kecamatan_name', 'domisili_kelurahan_code', 'domisili_kelurahan_name',
            'domisili_rt_rw', 'domisili_alamat_detail',
            'no_wa', 'email', 'jml_keluarga_inti', 'jml_keluarga_serumah',
        ];
        
        $callback = function () use ($columns) {
            echo '<table border="1">';
            echo '<tr>';
            foreach ($columns as $col) {
                echo '<th style="background-color: #f2f2f2; font-weight: bold;">' . $col . '</th>';
            }
            echo '</tr>';
            
            // Contoh baris data
            $exampleData = [
                '3276020101900001', 'Nama Lengkap Contoh', '1990-01-01', 'L', 'Islam',
                'S1', 'Wirausaha',
                '32', 'Jawa Barat', '32.01', 'Kab. Bogor', '32.01.01', 'Cibinong', '32.01.01.1001', 'Cibinong',
                '001/002', 'Jl. Contoh No. 1',
                '32', 'Jawa Barat', '32.01', 'Kab. Bogor', '32.01.01', 'Cibinong', '32.01.01.1001', 'Cibinong',
                '001/002', 'Jl. Contoh No. 1',
                '08123456789', 'contoh@email.com', '3', '4',
            ];
            
            echo '<tr>';
            foreach ($exampleData as $idx => $data) {
                // Jika kolom NIK (index 0) atau No HP, tambahkan atribut mso-number-format untuk force text (sebagai string)
                if ($idx === 0 || $idx === 27) {
                    echo '<td style="mso-number-format:\'\@\';">' . $data . '</td>';
                } else {
                    echo '<td>' . $data . '</td>';
                }
            }
            echo '</tr>';
            echo '</table>';
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Import data anggota dari file Excel
     */
    public function import(Request $request, \App\Services\KartuAnggotaService $kartuService): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:5120',
        ]);
        
        try {
            $file = $request->file('file')->getRealPath();
            $xlsx = \Shuchkin\SimpleXLSX::parse($file);
            
            if (!$xlsx) {
                throw new \Exception(\Shuchkin\SimpleXLSX::parseError());
            }
            
            $header_values = $rows = [];
            
            foreach ($xlsx->rows() as $k => $r) {
                if ($k === 0) {
                    $header_values = $r;
                    continue;
                }
                $rows[] = array_combine($header_values, $r);
            }
            
            $successCount = 0;
            
            foreach ($rows as $row) {
                // Lewati jika NIK kosong
                if (empty($row['nik'])) {
                    continue;
                }

                // Cek apakah NIK sudah ada
                if (\App\Models\Anggota::where('nik', $row['nik'])->exists()) {
                    continue; // Skip data yang duplikat
                }
                
                // Pastikan format tanggal Excel (.xlsx) di-parse dengan benar
                $tanggalLahir = null;
                if (!empty($row['tanggal_lahir'])) {
                    if (is_numeric($row['tanggal_lahir'])) {
                        // Excel date to PHP format (1900-based)
                        $unix_date = ($row['tanggal_lahir'] - 25569) * 86400;
                        $tanggalLahir = gmdate("Y-m-d", $unix_date);
                    } else {
                        $tanggalLahir = date('Y-m-d', strtotime($row['tanggal_lahir']));
                    }
                }

                $data = [
                    'nik' => (string) $row['nik'],
                    'nama_lengkap' => $row['nama_lengkap'] ?? '',
                    'tanggal_lahir' => $tanggalLahir,
                    'jenis_kelamin' => isset($row['jenis_kelamin']) ? strtoupper($row['jenis_kelamin']) : 'L',
                    'agama' => $row['agama'] ?? '',
                    'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?? '',
                    'pekerjaan' => $row['pekerjaan'] ?? '',
                    
                    'ktp_provinsi_code' => $row['ktp_provinsi_code'] ?? '',
                    'ktp_provinsi_name' => $row['ktp_provinsi_name'] ?? ($row['ktp_provinsi_code'] ?? ''),
                    'ktp_kota_code' => $row['ktp_kota_code'] ?? '',
                    'ktp_kota_name' => $row['ktp_kota_name'] ?? ($row['ktp_kota_code'] ?? ''),
                    'ktp_kecamatan_code' => $row['ktp_kecamatan_code'] ?? '',
                    'ktp_kecamatan_name' => $row['ktp_kecamatan_name'] ?? ($row['ktp_kecamatan_code'] ?? ''),
                    'ktp_kelurahan_code' => $row['ktp_kelurahan_code'] ?? '',
                    'ktp_kelurahan_name' => $row['ktp_kelurahan_name'] ?? ($row['ktp_kelurahan_code'] ?? ''),
                    'ktp_rt_rw' => $row['ktp_rt_rw'] ?? '',
                    'ktp_alamat_detail' => $row['ktp_alamat_detail'] ?? '',
                    
                    'domisili_provinsi_code' => $row['domisili_provinsi_code'] ?? '',
                    'domisili_provinsi_name' => $row['domisili_provinsi_name'] ?? ($row['domisili_provinsi_code'] ?? ''),
                    'domisili_kota_code' => $row['domisili_kota_code'] ?? '',
                    'domisili_kota_name' => $row['domisili_kota_name'] ?? ($row['domisili_kota_code'] ?? ''),
                    'domisili_kecamatan_code' => $row['domisili_kecamatan_code'] ?? '',
                    'domisili_kecamatan_name' => $row['domisili_kecamatan_name'] ?? ($row['domisili_kecamatan_code'] ?? ''),
                    'domisili_kelurahan_code' => $row['domisili_kelurahan_code'] ?? '',
                    'domisili_kelurahan_name' => $row['domisili_kelurahan_name'] ?? ($row['domisili_kelurahan_code'] ?? ''),
                    'domisili_rt_rw' => $row['domisili_rt_rw'] ?? '',
                    'domisili_alamat_detail' => $row['domisili_alamat_detail'] ?? '',
                    
                    'no_wa' => $row['no_wa'] ?? '',
                    'email' => $row['email'] ?? null,
                    'jml_keluarga_inti' => (int) ($row['jml_keluarga_inti'] ?? 0),
                    'jml_keluarga_serumah' => (int) ($row['jml_keluarga_serumah'] ?? 0),
                    'is_active' => true,
                    'registered_by' => auth()->id(),
                    'registered_at' => now(),
                ];

                try {
                    $data['no_kartu'] = $kartuService->generateNoKartu($data);
                    \App\Models\Anggota::create($data);
                    $successCount++;
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Error import baris: ' . $e->getMessage());
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil diimport (' . $successCount . ' baris sukses).',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat import: ' . $e->getMessage(),
            ], 500);
        }
    }
}