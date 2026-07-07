@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h4 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-user-edit me-2"></i> Edit Data Anggota
                    </h4>
                    <p class="text-muted small mt-1">Perbarui data anggota: {{ $anggota->nama_lengkap }}</p>
                </div>
                
                <div class="card-body px-4 pb-5">
                    
                    <!-- Sweet Stepper UI -->
                    <div class="stepper-wrapper d-flex justify-content-between mb-5 mt-2 position-relative">
                        <div class="stepper-line" style="position: absolute; top: 17px; left: 12%; right: 12%; height: 3px; background: var(--primary-light); z-index: 1; border-radius: 5px;"></div>
                        
                        <div class="stepper-item d-flex flex-column align-items-center" id="stepper-1" style="z-index: 2; width: 25%;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 38px; height: 38px; font-weight: bold; transition: all 0.3s; border: 2px solid var(--primary-color);">1</div>
                            <small class="fw-bold text-primary">Data Pribadi</small>
                        </div>
                        
                        <div class="stepper-item d-flex flex-column align-items-center" id="stepper-2" style="z-index: 2; width: 25%;">
                            <div class="step-circle bg-white text-muted rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; font-weight: bold; transition: all 0.3s; border: 2px solid #e9ecef;">2</div>
                            <small class="text-muted" style="transition: 0.3s;">Alamat KTP</small>
                        </div>
                        
                        <div class="stepper-item d-flex flex-column align-items-center" id="stepper-3" style="z-index: 2; width: 25%;">
                            <div class="step-circle bg-white text-muted rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; font-weight: bold; transition: all 0.3s; border: 2px solid #e9ecef;">3</div>
                            <small class="text-muted" style="transition: 0.3s;">Domisili</small>
                        </div>
                        
                        <div class="stepper-item d-flex flex-column align-items-center" id="stepper-4" style="z-index: 2; width: 25%;">
                            <div class="step-circle bg-white text-muted rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; font-weight: bold; transition: all 0.3s; border: 2px solid #e9ecef;">4</div>
                            <small class="text-muted" style="transition: 0.3s;">Kontak</small>
                        </div>
                    </div>

                    <form id="formAnggota">
                        @csrf
                        @method('PUT')
                        
                        <!-- Step 1: Data Pribadi -->
                        <div id="step1" class="form-step">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" id="nik" class="form-control" 
                                           maxlength="16" placeholder="Masukkan 16 digit NIK" required
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)"
                                           value="{{ $anggota->nik }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control" 
                                           placeholder="Nama lengkap sesuai KTP" required
                                           value="{{ $anggota->nama_lengkap }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" 
                                           max="{{ date('Y-m-d') }}" required
                                           value="{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('Y-m-d') }}">
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khong Hu Chu', 'Penghayat Kepercayaan'] as $a)
                                            <option {{ $anggota->agama == $a ? 'selected' : '' }}>{{ $a }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                    <select name="pendidikan_terakhir" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach(['Tidak Sekolah', 'Belum Tamat SD', 'SD/MI', 'SMP/MTs', 'SMA/SMK/MA/MAK', 'S1', 'S2', 'S3'] as $p)
                                            <option {{ $anggota->pendidikan_terakhir == $p ? 'selected' : '' }}>{{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <select name="pekerjaan" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach(['Tidak Bekerja', 'Pelajar', 'Mahasiswa', 'Ibu Rumah Tangga', 'Karyawan Swasta/BUMN/BUMD', 'Pegawai Negeri Sipil/PPPK', 'Jabatan Publik', 'Petani/Nelayan', 'Guru/Dosen', 'Wirausaha', 'Buruh Harian Lepas'] as $pk)
                                            <option {{ $anggota->pekerjaan == $pk ? 'selected' : '' }}>{{ $pk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Hal yang Menjadi Ketertarikan Pribadi</label>
                                <div class="row">
                                    @php
                                        $ketertarikan = is_array($anggota->ketertarikan) ? $anggota->ketertarikan : json_decode($anggota->ketertarikan, true) ?? [];
                                    @endphp
                                    @foreach(['Pendidikan', 'Lingkungan Hidup', 'Sosial', 'Ekonomi', 'Politik', 'Sains dan Teknologi', 'Pertanian/Perikanan'] as $item)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="ketertarikan[]" value="{{ $item }}"
                                                       {{ in_array($item, $ketertarikan) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $item }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status Anggota</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1" {{ $anggota->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label">Aktif</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Alamat KTP -->
                        <div id="step2" class="form-step" style="display:none;">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <select name="ktp_provinsi_code" id="ktp_provinsi" class="form-select wilayah-select" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                    <input type="hidden" name="ktp_provinsi_name" id="ktp_provinsi_name" value="{{ $anggota->ktp_provinsi_name }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <select name="ktp_kota_code" id="ktp_kota" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Provinsi Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kota_name" id="ktp_kota_name" value="{{ $anggota->ktp_kota_name }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="ktp_kecamatan_code" id="ktp_kecamatan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kota Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kecamatan_name" id="ktp_kecamatan_name" value="{{ $anggota->ktp_kecamatan_name }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                    <select name="ktp_kelurahan_code" id="ktp_kelurahan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kecamatan Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kelurahan_name" id="ktp_kelurahan_name" value="{{ $anggota->ktp_kelurahan_name }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RT/RW</label>
                                    <input type="text" name="ktp_rt_rw" class="form-control" placeholder="000/000" oninput="formatRTRW(this)" maxlength="7" value="{{ $anggota->ktp_rt_rw }}">
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Alamat Detail <span class="text-danger">*</span></label>
                                    <textarea name="ktp_alamat_detail" class="form-control" rows="2" 
                                              placeholder="Nama jalan, nomor rumah, dsb" required>{{ $anggota->ktp_alamat_detail }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3: Alamat Domisili -->
                        <div id="step3" class="form-step" style="display:none;">
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sama_ktp">
                                    <label class="form-check-label" for="sama_ktp">
                                        <strong>Alamat domisili sama dengan Alamat KTP</strong>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <select name="domisili_provinsi_code" id="domisili_provinsi" class="form-select wilayah-select" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                    <input type="hidden" name="domisili_provinsi_name" id="domisili_provinsi_name" value="{{ $anggota->domisili_provinsi_name }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <select name="domisili_kota_code" id="domisili_kota" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Provinsi Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kota_name" id="domisili_kota_name" value="{{ $anggota->domisili_kota_name }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="domisili_kecamatan_code" id="domisili_kecamatan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kota Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kecamatan_name" id="domisili_kecamatan_name" value="{{ $anggota->domisili_kecamatan_name }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                    <select name="domisili_kelurahan_code" id="domisili_kelurahan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kecamatan Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kelurahan_name" id="domisili_kelurahan_name" value="{{ $anggota->domisili_kelurahan_name }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RT/RW</label>
                                    <input type="text" name="domisili_rt_rw" class="form-control" placeholder="000/000" oninput="formatRTRW(this)" maxlength="7" value="{{ $anggota->domisili_rt_rw }}">
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Alamat Detail <span class="text-danger">*</span></label>
                                    <textarea name="domisili_alamat_detail" class="form-control" rows="2" 
                                              placeholder="Nama jalan, nomor rumah, dsb" required>{{ $anggota->domisili_alamat_detail }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 4: Kontak & Keluarga -->
                        <div id="step4" class="form-step" style="display:none;">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">+62</span>
                                        @php
                                            $noWa = $anggota->no_wa;
                                            if (str_starts_with($noWa, '62')) $noWa = substr($noWa, 2);
                                            elseif (str_starts_with($noWa, '0')) $noWa = substr($noWa, 1);
                                        @endphp
                                        <input type="text" name="no_wa" class="form-control" 
                                               placeholder="81234567890" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $noWa }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com" value="{{ $anggota->email }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Anggota Keluarga Inti <span class="text-danger">*</span></label>
                                    <input type="number" name="jml_keluarga_inti" class="form-control" 
                                           min="0" max="50" required value="{{ $anggota->jml_keluarga_inti }}">
                                    <small class="text-muted">Suami, Istri, Ayah, Ibu, Kakak, Adik, Anak</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Anggota Keluarga Tinggal Serumah <span class="text-danger">*</span></label>
                                    <input type="number" name="jml_keluarga_serumah" class="form-control" 
                                           min="0" max="50" required value="{{ $anggota->jml_keluarga_serumah }}">
                                    <small class="text-muted">Suami, Istri, Ayah, Ibu, Kakak, Adik, Anak</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display:none;">
                                <i class="fas fa-arrow-left"></i> Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                                Selanjutnya <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary" style="margin-left: 5px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ============================================
// FORMATTER
// ============================================
function formatRTRW(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 3) {
        value = value.substring(0, 3) + '/' + value.substring(3, 6);
    }
    input.value = value;
}

// ============================================
// STEP NAVIGATION
// ============================================
let currentStep = 1;
const totalSteps = 4;

function showStep(step) {
    $('.form-step').hide().css('opacity', 0);
    $('#step' + step).show().animate({opacity: 1}, 300);
    
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
    
    for(let i=1; i<=totalSteps; i++) {
        let circle = $('#stepper-' + i + ' .step-circle');
        let text = $('#stepper-' + i + ' small');
        
        if (i < step) {
            circle.removeClass('bg-white text-muted border border-primary').addClass('bg-primary text-white shadow-sm').html('<i class="fas fa-check"></i>').css('border-color', 'var(--primary-color)');
            text.removeClass('text-muted text-primary').addClass('text-primary fw-bold');
        } else if (i === step) {
            circle.removeClass('bg-white text-muted border bg-success').addClass('bg-primary text-white shadow-sm').html(i).css('border-color', 'var(--primary-color)');
            text.removeClass('text-muted text-success').addClass('text-primary fw-bold');
        } else {
            circle.removeClass('bg-primary text-white shadow-sm bg-success').addClass('bg-white text-muted').html(i).css('border-color', '#e9ecef');
            text.removeClass('text-primary fw-bold text-success').addClass('text-muted').removeClass('fw-bold');
        }
    }
}

function changeStep(direction) {
    if (direction === 1) {
        const currentFormStep = document.getElementById('step' + currentStep);
        const inputs = currentFormStep.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        for (let i = 0; i < inputs.length; i++) {
            if (!inputs[i].checkValidity()) {
                inputs[i].reportValidity();
                isValid = false;
                break;
            }
        }
        if (!isValid) return;
    }

    const newStep = currentStep + direction;
    if (newStep >= 1 && newStep <= totalSteps) {
        currentStep = newStep;
        showStep(currentStep);
    }
}

// ============================================
// WILAYAH DATA LOADING
// ============================================
const API_BASE = '/api/wilayah';

const initData = {
    ktp_prov: '{{ $anggota->ktp_provinsi_code }}',
    ktp_kota: '{{ $anggota->ktp_kota_code }}',
    ktp_kec: '{{ $anggota->ktp_kecamatan_code }}',
    ktp_kel: '{{ $anggota->ktp_kelurahan_code }}',
    
    dom_prov: '{{ $anggota->domisili_provinsi_code }}',
    dom_kota: '{{ $anggota->domisili_kota_code }}',
    dom_kec: '{{ $anggota->domisili_kecamatan_code }}',
    dom_kel: '{{ $anggota->domisili_kelurahan_code }}',
};

function loadProvinces(selectId, selectedVal = null, callback = null) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.get(API_BASE + '/provinsi', function(response) {
        let options = '<option value="">-- Pilih Provinsi --</option>';
        let data = Array.isArray(response) ? response : (response.data || Object.values(response.data || {}));
        data.forEach(item => {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        select.html(options).prop('disabled', false);
        if (selectedVal) select.val(selectedVal);
        if (callback) callback();
    });
}

function loadRegencies(provinceCode, selectId, selectedVal = null, callback = null) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.get(API_BASE + '/kabupaten/' + provinceCode, function(response) {
        let options = '<option value="">-- Pilih Kota/Kabupaten --</option>';
        let data = Array.isArray(response) ? response : (response.data || Object.values(response.data || {}));
        data.forEach(item => {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        select.html(options).prop('disabled', false);
        if (selectedVal) select.val(selectedVal);
        if (callback) callback();
    });
}

function loadDistricts(regencyCode, selectId, selectedVal = null, callback = null) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.get(API_BASE + '/kecamatan/' + regencyCode, function(response) {
        let options = '<option value="">-- Pilih Kecamatan --</option>';
        let data = Array.isArray(response) ? response : (response.data || Object.values(response.data || {}));
        data.forEach(item => {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        select.html(options).prop('disabled', false);
        if (selectedVal) select.val(selectedVal);
        if (callback) callback();
    });
}

function loadVillages(districtCode, selectId, selectedVal = null, callback = null) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.get(API_BASE + '/kelurahan/' + districtCode, function(response) {
        let options = '<option value="">-- Pilih Kelurahan/Desa --</option>';
        let data = Array.isArray(response) ? response : (response.data || Object.values(response.data || {}));
        data.forEach(item => {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        select.html(options).prop('disabled', false);
        if (selectedVal) select.val(selectedVal);
        if (callback) callback();
    });
}

// ============================================
// EVENT HANDLERS
// ============================================
$(document).ready(function() {
    
    // Load initial data
    loadProvinces('ktp_provinsi', initData.ktp_prov, function() {
        if(initData.ktp_prov) {
            loadRegencies(initData.ktp_prov, 'ktp_kota', initData.ktp_kota, function() {
                if(initData.ktp_kota) {
                    loadDistricts(initData.ktp_kota, 'ktp_kecamatan', initData.ktp_kec, function() {
                        if(initData.ktp_kec) {
                            loadVillages(initData.ktp_kec, 'ktp_kelurahan', initData.ktp_kel);
                        }
                    });
                }
            });
        }
    });

    loadProvinces('domisili_provinsi', initData.dom_prov, function() {
        if(initData.dom_prov) {
            loadRegencies(initData.dom_prov, 'domisili_kota', initData.dom_kota, function() {
                if(initData.dom_kota) {
                    loadDistricts(initData.dom_kota, 'domisili_kecamatan', initData.dom_kec, function() {
                        if(initData.dom_kec) {
                            loadVillages(initData.dom_kec, 'domisili_kelurahan', initData.dom_kel);
                        }
                    });
                }
            });
        }
    });

    // KTP Change Events
    $('#ktp_provinsi').on('change', function() {
        const code = $(this).val();
        $('#ktp_provinsi_name').val($(this).find('option:selected').text());
        if (code) {
            loadRegencies(code, 'ktp_kota');
            $('#ktp_kota_name, #ktp_kecamatan_name, #ktp_kelurahan_name').val('');
            $('#ktp_kecamatan, #ktp_kelurahan').html('<option value="">-- Pilih --</option>').prop('disabled', true);
        }
    });
    $('#ktp_kota').on('change', function() {
        const code = $(this).val();
        $('#ktp_kota_name').val($(this).find('option:selected').text());
        if (code) {
            loadDistricts(code, 'ktp_kecamatan');
            $('#ktp_kecamatan_name, #ktp_kelurahan_name').val('');
            $('#ktp_kelurahan').html('<option value="">-- Pilih --</option>').prop('disabled', true);
        }
    });
    $('#ktp_kecamatan').on('change', function() {
        const code = $(this).val();
        $('#ktp_kecamatan_name').val($(this).find('option:selected').text());
        if (code) {
            loadVillages(code, 'ktp_kelurahan');
            $('#ktp_kelurahan_name').val('');
        }
    });
    $('#ktp_kelurahan').on('change', function() {
        $('#ktp_kelurahan_name').val($(this).val() ? $(this).find('option:selected').text() : '');
    });

    // Domisili Change Events
    $('#domisili_provinsi').on('change', function() {
        const code = $(this).val();
        $('#domisili_provinsi_name').val($(this).find('option:selected').text());
        if (code) {
            loadRegencies(code, 'domisili_kota');
            $('#domisili_kota_name, #domisili_kecamatan_name, #domisili_kelurahan_name').val('');
            $('#domisili_kecamatan, #domisili_kelurahan').html('<option value="">-- Pilih --</option>').prop('disabled', true);
        }
    });
    $('#domisili_kota').on('change', function() {
        const code = $(this).val();
        $('#domisili_kota_name').val($(this).find('option:selected').text());
        if (code) {
            loadDistricts(code, 'domisili_kecamatan');
            $('#domisili_kecamatan_name, #domisili_kelurahan_name').val('');
            $('#domisili_kelurahan').html('<option value="">-- Pilih --</option>').prop('disabled', true);
        }
    });
    $('#domisili_kecamatan').on('change', function() {
        const code = $(this).val();
        $('#domisili_kecamatan_name').val($(this).find('option:selected').text());
        if (code) {
            loadVillages(code, 'domisili_kelurahan');
            $('#domisili_kelurahan_name').val('');
        }
    });
    $('#domisili_kelurahan').on('change', function() {
        $('#domisili_kelurahan_name').val($(this).val() ? $(this).find('option:selected').text() : '');
    });

    $('#sama_ktp').on('change', function() {
        if ($(this).is(':checked')) {
            const ktpProv = $('#ktp_provinsi').val();
            $('#domisili_provinsi').val(ktpProv);
            if (ktpProv) {
                $('#domisili_provinsi_name').val($('#ktp_provinsi_name').val());
                $('#domisili_kota').html($('#ktp_kota').html()).val($('#ktp_kota').val());
                $('#domisili_kota_name').val($('#ktp_kota_name').val());
                $('#domisili_kecamatan').html($('#ktp_kecamatan').html()).val($('#ktp_kecamatan').val());
                $('#domisili_kecamatan_name').val($('#ktp_kecamatan_name').val());
                $('#domisili_kelurahan').html($('#ktp_kelurahan').html()).val($('#ktp_kelurahan').val());
                $('#domisili_kelurahan_name').val($('#ktp_kelurahan_name').val());
            }
            $('#domisili_provinsi, #domisili_kota, #domisili_kecamatan, #domisili_kelurahan').prop('disabled', true);
            $('input[name="domisili_rt_rw"], textarea[name="domisili_alamat_detail"]').prop('disabled', true);
            $('input[name="domisili_rt_rw"]').val($('input[name="ktp_rt_rw"]').val());
            $('textarea[name="domisili_alamat_detail"]').val($('textarea[name="ktp_alamat_detail"]').val());
        } else {
            $('#domisili_provinsi, #domisili_kota, #domisili_kecamatan, #domisili_kelurahan').prop('disabled', false);
            $('input[name="domisili_rt_rw"], textarea[name="domisili_alamat_detail"]').prop('disabled', false);
        }
    });
    
    // Submit Form
    $('#formAnggota').on('submit', function(e) {
        e.preventDefault();
        
        if ($('#sama_ktp').is(':checked')) {
            $('#domisili_provinsi, #domisili_kota, #domisili_kecamatan, #domisili_kelurahan').prop('disabled', false);
            $('input[name="domisili_rt_rw"], textarea[name="domisili_alamat_detail"]').prop('disabled', false);
        }
        
        Swal.fire({
            title: 'Menyimpan Data...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });
        
        $.ajax({
            url: '{{ route("admin.anggota.update", $anggota->id) }}',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '{{ route("admin.anggota.index") }}';
                });
            },
            error: function(xhr) {
                let message = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                }
                Swal.fire({ icon: 'error', title: 'Oops...', text: message });
            }
        });
    });
    
    showStep(1);
});
</script>
@endpush
@endsection
