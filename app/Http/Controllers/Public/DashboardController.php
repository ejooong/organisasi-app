<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard publik
        $stats = [
            'total_anggota' => Anggota::active()->count(),
            'total_laki' => Anggota::active()->where('jenis_kelamin', 'L')->count(),
            'total_perempuan' => Anggota::active()->where('jenis_kelamin', 'P')->count(),
        ];
        
        // Data untuk chart distribusi agama
        $agamaChart = Anggota::active()
            ->select('agama', DB::raw('count(*) as total'))
            ->groupBy('agama')
            ->get();
        
        // Data untuk chart distribusi pekerjaan
        $pekerjaanChart = Anggota::active()
            ->select('pekerjaan', DB::raw('count(*) as total'))
            ->groupBy('pekerjaan')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        
        // Data untuk chart provinsi
        $provinsiChart = Anggota::active()
            ->select('domisili_provinsi_name', DB::raw('count(*) as total'))
            ->groupBy('domisili_provinsi_name')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        
        // Data pertumbuhan anggota per bulan (tahun ini)
        $pertumbuhan = Anggota::active()
            ->whereYear('created_at', date('Y'))
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('count(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        return view('public.dashboard', compact(
            'stats',
            'agamaChart',
            'pekerjaanChart',
            'provinsiChart',
            'pertumbuhan'
        ));
    }
}