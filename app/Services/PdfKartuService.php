<?php

namespace App\Services;

use App\Models\Anggota;
use App\Models\KartuLayout;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfKartuService
{
    /**
     * Generate PDF kartu anggota
     */
    public function generate(Anggota $anggota, $layoutId = null)
    {
        // Ambil layout aktif
        $layout = null;
        if ($layoutId) {
            $layout = KartuLayout::find($layoutId);
        } else {
            $layout = KartuLayout::active()->first();
        }
        
        // Generate QR Code
        $qrCode = $this->generateQRCode($anggota);
        
        // Data untuk template
        $data = [
            'anggota' => $anggota,
            'layout' => $layout,
            'qrCode' => $qrCode,
            'tanggal_cetak' => now()->format('d/m/Y'),
        ];
        
        // Pilih template berdasarkan layout
        $template = 'pdf.kartu.default';
        if ($layout && $layout->tipe_file === 'html') {
            $template = 'pdf.kartu.custom';
        }
        
        // Generate PDF
        $pdf = PDF::loadView($template, $data);
        $pdf->setPaper([0, 0, 153, 241], 'landscape'); // Ukuran ID card landscape 85x54mm
        
        return $pdf;
    }
    
    /**
     * Generate QR Code untuk verifikasi
     */
    public function generateQRCode(Anggota $anggota)
    {
        $data = json_encode([
            'no_kartu' => $anggota->no_kartu,
            'nama' => $anggota->nama_lengkap,
            'nik' => $anggota->nik,
            'url' => route('verifikasi.kartu', $anggota->no_kartu),
        ]);
        
        // Simpan QR code ke storage
        $qrDir = 'qrcodes';
        if (!Storage::disk('public')->exists($qrDir)) {
            Storage::disk('public')->makeDirectory($qrDir);
        }
        
        $qrPath = $qrDir . '/' . $anggota->no_kartu . '.svg';
        
        QrCode::format('svg')
            ->size(200)
            ->errorCorrection('H')
            ->generate($data, storage_path('app/public/' . $qrPath));
        
        return $qrPath;
    }
    
    /**
     * Download PDF
     */
    public function download(Anggota $anggota, $layoutId = null)
    {
        $pdf = $this->generate($anggota, $layoutId);
        return $pdf->download('kartu-anggota-' . $anggota->no_kartu . '.pdf');
    }
    
    /**
     * Stream PDF
     */
    public function stream(Anggota $anggota, $layoutId = null)
    {
        $pdf = $this->generate($anggota, $layoutId);
        return $pdf->stream('kartu-anggota-' . $anggota->no_kartu . '.pdf');
    }
    
    /**
     * Simpan PDF ke storage
     */
    public function save(Anggota $anggota, $layoutId = null)
    {
        $pdf = $this->generate($anggota, $layoutId);
        $path = 'kartu-anggota/' . $anggota->no_kartu . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());
        return $path;
    }
}