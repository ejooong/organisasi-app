<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $layout = \App\Models\KartuLayout::active()->first();
        return view('admin.layout.index', compact('layout'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'background_image_depan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$request->hasFile('background_image') && !$request->hasFile('background_image_depan')) {
            return back()->with('error', 'Silakan upload setidaknya satu gambar layout (Depan atau Belakang).');
        }

        $activeLayout = \App\Models\KartuLayout::active()->first();
        
        $pathBelakang = $activeLayout ? $activeLayout->file_path : null;
        $pathDepan = $activeLayout ? $activeLayout->file_path_depan : null;

        if ($request->hasFile('background_image')) {
            $pathBelakang = $request->file('background_image')->store('layouts', 'public');
        }
        
        if ($request->hasFile('background_image_depan')) {
            $pathDepan = $request->file('background_image_depan')->store('layouts', 'public');
        }

        // Nonaktifkan layout lama
        \App\Models\KartuLayout::where('is_active', true)->update(['is_active' => false]);

        // Buat layout baru
        \App\Models\KartuLayout::create([
            'nama_layout' => 'Custom Layout ' . date('Y-m-d H:i:s'),
            'file_path' => $pathBelakang,
            'file_path_depan' => $pathDepan,
            'tipe_file' => 'image',
            'field_positions' => $activeLayout ? $activeLayout->field_positions : [], // copy existing positions or empty
            'is_active' => true,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Layout berhasil diperbarui!');
    }

    public function updatePositions(Request $request)
    {
        $layout = \App\Models\KartuLayout::active()->first();
        if (!$layout) {
            return back()->with('error', 'Silakan upload layout terlebih dahulu.');
        }

        $positions = [
            'color' => $request->color ?? '#ffffff',
            'no_kartu' => [
                'top' => $request->no_kartu_top ?? '5',
                'left' => $request->no_kartu_left ?? '50',
                'size' => $request->no_kartu_size ?? '10',
            ],
            'nama' => [
                'top' => $request->nama_top ?? '25',
                'left' => $request->nama_left ?? '5',
                'size' => $request->nama_size ?? '14',
            ],
            'qr' => [
                'top' => $request->qr_top ?? '35',
                'left' => $request->qr_left ?? '68',
                'size' => $request->qr_size ?? '12',
            ]
        ];

        $layout->update(['field_positions' => $positions]);

        return back()->with('success', 'Posisi text dan QR berhasil disimpan!');
    }
}
