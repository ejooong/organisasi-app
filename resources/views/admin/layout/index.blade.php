@extends('layouts.app')

@section('title', 'Manajemen Layout Kartu')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manajemen Layout Kartu</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.layout.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="background_image_depan" class="form-label">1. Upload Background Kartu (Depan)</label>
                            <input class="form-control" type="file" id="background_image_depan" name="background_image_depan" accept="image/jpeg, image/png, image/jpg">
                            <small class="text-muted">Gambar akan menutupi seluruh background depan (Format: JPG/PNG, Max: 2MB).</small>
                        </div>
                        <div class="mb-3">
                            <label for="background_image" class="form-label">2. Upload Background Kartu (Belakang)</label>
                            <input class="form-control" type="file" id="background_image" name="background_image" accept="image/jpeg, image/png, image/jpg">
                            <small class="text-muted">Gambar akan menutupi seluruh background belakang (Format: JPG/PNG, Max: 2MB).</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Layout</button>
                    </form>

                    <hr>

                    <form action="{{ route('admin.layout.positions') }}" method="POST">
                        @csrf
                        <h6 class="font-weight-bold">2. Pengaturan Posisi (Satuan Milimeter / mm)</h6>
                        <p class="small text-muted">Sesuaikan letak X (kiri) dan Y (atas) dari ujung kiri atas kartu.</p>
                        
                        <div class="row mb-2">
                            <div class="col-4"><label>Warna Teks</label></div>
                            <div class="col-8"><input type="color" name="color" class="form-control form-control-color" value="{{ $layout->field_positions['color'] ?? '#ffffff' }}"></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12 font-weight-bold">Nomor Anggota</div>
                            <div class="col-4"><input type="number" name="no_kartu_left" class="form-control" placeholder="X (kiri)" value="{{ $layout->field_positions['no_kartu']['left'] ?? '50' }}"></div>
                            <div class="col-4"><input type="number" name="no_kartu_top" class="form-control" placeholder="Y (atas)" value="{{ $layout->field_positions['no_kartu']['top'] ?? '5' }}"></div>
                            <div class="col-4"><input type="number" name="no_kartu_size" class="form-control" placeholder="Ukuran (pt)" value="{{ $layout->field_positions['no_kartu']['size'] ?? '10' }}"></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12 font-weight-bold">Nama Anggota</div>
                            <div class="col-4"><input type="number" name="nama_left" class="form-control" placeholder="X (kiri)" value="{{ $layout->field_positions['nama']['left'] ?? '5' }}"></div>
                            <div class="col-4"><input type="number" name="nama_top" class="form-control" placeholder="Y (atas)" value="{{ $layout->field_positions['nama']['top'] ?? '25' }}"></div>
                            <div class="col-4"><input type="number" name="nama_size" class="form-control" placeholder="Ukuran (pt)" value="{{ $layout->field_positions['nama']['size'] ?? '14' }}"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 font-weight-bold">QR Code</div>
                            <div class="col-4"><input type="number" name="qr_left" class="form-control" placeholder="X (kiri)" value="{{ $layout->field_positions['qr']['left'] ?? '68' }}"></div>
                            <div class="col-4"><input type="number" name="qr_top" class="form-control" placeholder="Y (atas)" value="{{ $layout->field_positions['qr']['top'] ?? '35' }}"></div>
                            <div class="col-4"><input type="number" name="qr_size" class="form-control" placeholder="Ukuran (mm)" value="{{ $layout->field_positions['qr']['size'] ?? '12' }}"></div>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Posisi</button>
                    </form>
                </div>
                
                <div class="col-md-6">
                    <h5>Preview Tata Letak (Live):</h5>
                    @if(isset($layout) && $layout)
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-light py-2">
                                <h6 class="m-0 font-weight-bold text-secondary">Bagian Depan</h6>
                            </div>
                            <div class="card-body d-flex justify-content-center bg-light">
                                <div style="position: relative; width: 85mm; height: 54mm; border: 1px solid #ccc; overflow: hidden; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    @if($layout->file_path_depan)
                                        <img src="{{ asset('storage/' . $layout->file_path_depan) }}" style="position: absolute; top:0; left:0; width: 100%; height: 100%; z-index: 1;" alt="Background Depan">
                                    @else
                                        <div style="position: absolute; top:0; left:0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #999;">
                                            Belum ada background depan
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-light py-2">
                                <h6 class="m-0 font-weight-bold text-secondary">Bagian Belakang</h6>
                            </div>
                            <div class="card-body d-flex justify-content-center bg-light">
                                <div id="live-preview" style="position: relative; width: 85mm; height: 54mm; border: 1px solid #ccc; overflow: hidden; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    @if($layout->file_path)
                                        <img src="{{ asset('storage/' . $layout->file_path) }}" style="position: absolute; top:0; left:0; width: 100%; height: 100%; z-index: 1;" alt="Background Belakang">
                                    @endif
                                    
                                    <div id="preview-no" style="position: absolute; z-index: 2; font-weight: bold; white-space: nowrap;
                                        top: {{ $layout->field_positions['no_kartu']['top'] ?? '5' }}mm; 
                                        left: {{ $layout->field_positions['no_kartu']['left'] ?? '50' }}mm; 
                                        font-size: {{ $layout->field_positions['no_kartu']['size'] ?? '10' }}pt; 
                                        color: {{ $layout->field_positions['color'] ?? '#ffffff' }};">
                                        1111 2688 3201 0001
                                    </div>
                                    
                                    <div id="preview-nama" style="position: absolute; z-index: 2; font-weight: bold; text-transform: uppercase; white-space: nowrap;
                                        top: {{ $layout->field_positions['nama']['top'] ?? '25' }}mm; 
                                        left: {{ $layout->field_positions['nama']['left'] ?? '5' }}mm; 
                                        font-size: {{ $layout->field_positions['nama']['size'] ?? '14' }}pt; 
                                        color: {{ $layout->field_positions['color'] ?? '#ffffff' }};">
                                        NAMA ANGGOTA
                                    </div>
                                    
                                    <div id="preview-qr" style="position: absolute; z-index: 2; border: 2px dashed rgba(255,255,255,0.8); background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; color: white; font-size: 8pt; font-weight: bold;
                                        top: {{ $layout->field_positions['qr']['top'] ?? '35' }}mm; 
                                        left: {{ $layout->field_positions['qr']['left'] ?? '68' }}mm; 
                                        width: {{ $layout->field_positions['qr']['size'] ?? '12' }}mm; 
                                        height: {{ $layout->field_positions['qr']['size'] ?? '12' }}mm;">
                                        QR
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center small text-muted">
                                Kotak preview ini berukuran skala asli (85 x 54 mm). Teks akan otomatis bergeser saat Anda mengubah angka di form sebelah kiri.
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">Belum ada layout custom. Sistem akan menggunakan layout default.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = {
            'color': { target: ['preview-no', 'preview-nama'], css: 'color', suffix: '' },
            
            'no_kartu_top': { target: 'preview-no', css: 'top', suffix: 'mm' },
            'no_kartu_left': { target: 'preview-no', css: 'left', suffix: 'mm' },
            'no_kartu_size': { target: 'preview-no', css: 'fontSize', suffix: 'pt' },
            
            'nama_top': { target: 'preview-nama', css: 'top', suffix: 'mm' },
            'nama_left': { target: 'preview-nama', css: 'left', suffix: 'mm' },
            'nama_size': { target: 'preview-nama', css: 'fontSize', suffix: 'pt' },
            
            'qr_top': { target: 'preview-qr', css: 'top', suffix: 'mm' },
            'qr_left': { target: 'preview-qr', css: 'left', suffix: 'mm' },
            'qr_size': { target: 'preview-qr', css: ['width', 'height'], suffix: 'mm' }
        };

        for (const [inputId, config] of Object.entries(inputs)) {
            const inputEl = document.querySelector(`[name="${inputId}"]`);
            if (inputEl) {
                inputEl.addEventListener('input', function(e) {
                    const targets = Array.isArray(config.target) ? config.target : [config.target];
                    const cssProps = Array.isArray(config.css) ? config.css : [config.css];
                    
                    targets.forEach(targetId => {
                        const targetEl = document.getElementById(targetId);
                        if (targetEl) {
                            cssProps.forEach(cssProp => {
                                targetEl.style[cssProp] = e.target.value + config.suffix;
                            });
                        }
                    });
                });
            }
        }
    });
</script>
@endpush
@endsection
