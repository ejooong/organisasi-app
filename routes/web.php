<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\KartuController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorageProxyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Storage Proxy - Pengganti symlink untuk shared hosting
| File diambil langsung dari storage/app/public oleh Laravel
|--------------------------------------------------------------------------
*/
Route::get('/storage/{path}', [StorageProxyController::class, 'serve'])
    ->where('path', '.*')
    ->name('storage.serve');

/*
|--------------------------------------------------------------------------
| Root → Redirect ke Login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Verifikasi Kartu (Public - untuk scan QR)
|--------------------------------------------------------------------------
*/
Route::get('/verifikasi/kartu/{no_kartu}', function ($no_kartu) {
    $anggota = \App\Models\Anggota::where('no_kartu', $no_kartu)->firstOrFail();
    return view('public.verifikasi', compact('anggota'));
})->name('verifikasi.kartu');

/*
|--------------------------------------------------------------------------
| API Wilayah (Tanpa auth - dipakai saat form pendaftaran)
|--------------------------------------------------------------------------
*/
Route::prefix('api/wilayah')->group(function () {
    Route::get('/provinsi',                [WilayahController::class, 'provinsi']);
    Route::get('/kabupaten/{provinceCode}',[WilayahController::class, 'kabupaten']);
    Route::get('/kecamatan/{regencyCode}', [WilayahController::class, 'kecamatan']);
    Route::get('/kelurahan/{districtCode}',[WilayahController::class, 'kelurahan']);
    Route::get('/search',                  [WilayahController::class, 'search']);
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (Setelah login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('anggota')) {
        return redirect()->route('anggota.profil');
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes — TERBATAS (admin biasa)
| Hanya: lihat daftar, tambah anggota, cetak kartu
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin|super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Anggota — read + create + cetak (semua role admin)
    Route::get('anggota/datatable', [AnggotaController::class, 'dataTable'])->name('anggota.datatable');
    Route::get('anggota/export',    [AnggotaController::class, 'export'])   ->name('anggota.export');
    Route::post('anggota/import',   [AnggotaController::class, 'import'])   ->name('anggota.import');
    Route::get('anggota',           [AnggotaController::class, 'index'])    ->name('anggota.index');
    Route::get('anggota/create',    [AnggotaController::class, 'create'])   ->name('anggota.create');
    Route::post('anggota',          [AnggotaController::class, 'store'])    ->name('anggota.store');
    Route::get('anggota/{anggota}', [AnggotaController::class, 'show'])     ->name('anggota.show');

    // Cetak & Preview Kartu (semua role admin)
    Route::get('kartu/{id}/preview',  [KartuController::class, 'preview']) ->name('kartu.preview');
    Route::get('kartu/{id}/download', [KartuController::class, 'download'])->name('kartu.download');

    /*
    |----------------------------------------------------------------------
    | Super Admin ONLY — edit/delete anggota, layout, manajemen user/admin
    |----------------------------------------------------------------------
    */
    Route::middleware('role:super_admin')->group(function () {

        // Anggota — edit & delete
        Route::get('anggota/{anggota}/edit', [AnggotaController::class, 'edit'])   ->name('anggota.edit');
        Route::put('anggota/{anggota}',      [AnggotaController::class, 'update']) ->name('anggota.update');
        Route::patch('anggota/{anggota}',    [AnggotaController::class, 'update']);
        Route::delete('anggota/{anggota}',   [AnggotaController::class, 'destroy'])->name('anggota.destroy');


        // Layout Kartu
        Route::get('layout',              [LayoutController::class, 'index'])          ->name('layout.index');
        Route::post('layout/upload',      [LayoutController::class, 'upload'])         ->name('layout.upload');
        Route::post('layout/positions',   [LayoutController::class, 'updatePositions'])->name('layout.positions');

        // Manajemen User/Admin
        Route::get('users',          [UserManagementController::class, 'index'])  ->name('users.index');
        Route::get('users/create',   [UserManagementController::class, 'create']) ->name('users.create');
        Route::post('users',         [UserManagementController::class, 'store'])  ->name('users.store');
        Route::get('users/{user}/edit',    [UserManagementController::class, 'edit'])   ->name('users.edit');
        Route::put('users/{user}',         [UserManagementController::class, 'update']) ->name('users.update');
        Route::delete('users/{user}',      [UserManagementController::class, 'destroy'])->name('users.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Anggota Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/profil', function () {
        $anggota = auth()->user()->anggota;
        return view('anggota.profil', compact('anggota'));
    })->name('profil');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';