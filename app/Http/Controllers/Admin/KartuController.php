<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KartuController extends Controller
{
    protected $pdfKartuService;

    public function __construct(\App\Services\PdfKartuService $pdfKartuService)
    {
        $this->pdfKartuService = $pdfKartuService;
    }

    public function preview($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        return $this->pdfKartuService->stream($anggota);
    }

    public function download($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        return $this->pdfKartuService->download($anggota);
    }
}
