@extends('layouts.app')

@section('title', 'Tambah Anggota Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h4 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-user-plus me-2"></i> Form Pendaftaran Anggota Baru
                    </h4>
                    <p class="text-muted small mt-1">Lengkapi data di bawah ini untuk mendaftarkan anggota baru ke dalam sistem.</p>
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
                        
                        <!-- Step 1: Data Pribadi -->
                        <div id="step1" class="form-step">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" id="nik" class="form-control" 
                                           maxlength="16" placeholder="Masukkan 16 digit NIK" required
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control" 
                                           placeholder="Nama lengkap sesuai KTP" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" 
                                           max="{{ date('Y-m-d') }}" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option>Islam</option>
                                        <option>Kristen</option>
                                        <option>Katolik</option>
                                        <option>Hindu</option>
                                        <option>Buddha</option>
                                        <option>Khong Hu Chu</option>
                                        <option>Penghayat Kepercayaan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                    <select name="pendidikan_terakhir" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option>Tidak Sekolah</option>
                                        <option>Belum Tamat SD</option>
                                        <option>SD/MI</option>
                                        <option>SMP/MTs</option>
                                        <option>SMA/SMK/MA/MAK</option>
                                        <option>S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <select name="pekerjaan" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option>Tidak Bekerja</option>
                                        <option>Pelajar</option>
                                        <option>Mahasiswa</option>
                                        <option>Ibu Rumah Tangga</option>
                                        <option>Karyawan Swasta/BUMN/BUMD</option>
                                        <option>Pegawai Negeri Sipil/PPPK</option>
                                        <option>Jabatan Publik</option>
                                        <option>Petani/Nelayan</option>
                                        <option>Guru/Dosen</option>
                                        <option>Wirausaha</option>
                                        <option>Buruh Harian Lepas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Foto KTP <span class="text-danger">*</span></label>
                                    <input type="file" name="foto_ktp" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Hal yang Menjadi Ketertarikan Pribadi</label>
                                <div class="row">
                                    @foreach(['Pendidikan', 'Lingkungan Hidup', 'Sosial', 'Ekonomi', 'Politik', 'Sains dan Teknologi', 'Pertanian/Perikanan'] as $item)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="ketertarikan[]" value="{{ $item }}">
                                                <label class="form-check-label">{{ $item }}</label>
                                            </div>
                                        </div>
                                    @endforeach
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
                                    <input type="hidden" name="ktp_provinsi_name" id="ktp_provinsi_name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <select name="ktp_kota_code" id="ktp_kota" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Provinsi Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kota_name" id="ktp_kota_name">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="ktp_kecamatan_code" id="ktp_kecamatan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kota Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kecamatan_name" id="ktp_kecamatan_name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                    <select name="ktp_kelurahan_code" id="ktp_kelurahan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kecamatan Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="ktp_kelurahan_name" id="ktp_kelurahan_name">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RT/RW</label>
                                    <input type="text" name="ktp_rt_rw" class="form-control" placeholder="000/000" oninput="formatRTRW(this)" maxlength="7">
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Alamat Detail <span class="text-danger">*</span></label>
                                    <textarea name="ktp_alamat_detail" class="form-control" rows="2" 
                                              placeholder="Nama jalan, nomor rumah, dsb" required></textarea>
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
                                    <input type="hidden" name="domisili_provinsi_name" id="domisili_provinsi_name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <select name="domisili_kota_code" id="domisili_kota" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Provinsi Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kota_name" id="domisili_kota_name">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="domisili_kecamatan_code" id="domisili_kecamatan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kota Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kecamatan_name" id="domisili_kecamatan_name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                    <select name="domisili_kelurahan_code" id="domisili_kelurahan" class="form-select wilayah-select" required disabled>
                                        <option value="">-- Pilih Kecamatan Dahulu --</option>
                                    </select>
                                    <input type="hidden" name="domisili_kelurahan_name" id="domisili_kelurahan_name">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">RT/RW</label>
                                    <input type="text" name="domisili_rt_rw" class="form-control" placeholder="000/000" oninput="formatRTRW(this)" maxlength="7">
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Alamat Detail <span class="text-danger">*</span></label>
                                    <textarea name="domisili_alamat_detail" class="form-control" rows="2" 
                                              placeholder="Nama jalan, nomor rumah, dsb" required></textarea>
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
                                        <input type="text" name="no_wa" class="form-control" 
                                               placeholder="81234567890" required
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Anggota Keluarga Inti <span class="text-danger">*</span></label>
                                    <input type="number" name="jml_keluarga_inti" class="form-control" 
                                           min="0" max="50" value="0" required>
                                    <small class="text-muted">Suami, Istri, Ayah, Ibu, Kakak, Adik, Anak</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Anggota Keluarga Tinggal Serumah <span class="text-danger">*</span></label>
                                    <input type="number" name="jml_keluarga_serumah" class="form-control" 
                                           min="0" max="50" value="0" required>
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
                                <i class="fas fa-save"></i> Simpan & Cetak Kartu
                            </button>
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
    // Fade out and fade in the forms smoothly
    $('.form-step').hide().css('opacity', 0);
    $('#step' + step).show().animate({opacity: 1}, 300);
    
    // Update navigation buttons
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
    
    // Update Sweet Stepper UI
    for(let i=1; i<=totalSteps; i++) {
        let circle = $('#stepper-' + i + ' .step-circle');
        let text = $('#stepper-' + i + ' small');
        
        if (i < step) {
            // Completed steps
            circle.removeClass('bg-white text-muted border border-primary').addClass('bg-primary text-white shadow-sm').html('<i class="fas fa-check"></i>').css('border-color', 'var(--primary-color)');
            text.removeClass('text-muted text-primary').addClass('text-primary fw-bold');
        } else if (i === step) {
            // Current step
            circle.removeClass('bg-white text-muted border bg-success').addClass('bg-primary text-white shadow-sm').html(i).css('border-color', 'var(--primary-color)');
            text.removeClass('text-muted text-success').addClass('text-primary fw-bold');
        } else {
            // Future steps
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

// API Base URL
const API_BASE = '/api/wilayah';

// Load provinsi
function loadProvinces(selectId) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>');
    select.prop('disabled', true);
    
    $.get(API_BASE + '/provinsi', function(response) {
        let options = '<option value="">-- Pilih Provinsi --</option>';
        let data = [];
        
        // Handle berbagai format response
        if (Array.isArray(response)) {
            data = response;
        } else if (response.data && Array.isArray(response.data)) {
            data = response.data;
        } else if (response.data && typeof response.data === 'object') {
            data = Object.values(response.data);
        }
        
        data.forEach(function(item) {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        
        select.html(options);
        select.prop('disabled', false);
    }).fail(function() {
        select.html('<option value="">Gagal memuat</option>');
    });
}

// Load kabupaten/kota
function loadRegencies(provinceCode, selectId) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>');
    select.prop('disabled', true);
    
    $.get(API_BASE + '/kabupaten/' + provinceCode, function(response) {
        let options = '<option value="">-- Pilih Kota/Kabupaten --</option>';
        let data = [];
        
        if (Array.isArray(response)) {
            data = response;
        } else if (response.data && Array.isArray(response.data)) {
            data = response.data;
        } else if (response.data && typeof response.data === 'object') {
            data = Object.values(response.data);
        }
        
        data.forEach(function(item) {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        
        select.html(options);
        select.prop('disabled', false);
    }).fail(function() {
        select.html('<option value="">Gagal memuat</option>');
    });
}

// Load kecamatan
function loadDistricts(regencyCode, selectId) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>');
    select.prop('disabled', true);
    
    $.get(API_BASE + '/kecamatan/' + regencyCode, function(response) {
        let options = '<option value="">-- Pilih Kecamatan --</option>';
        let data = [];
        
        if (Array.isArray(response)) {
            data = response;
        } else if (response.data && Array.isArray(response.data)) {
            data = response.data;
        } else if (response.data && typeof response.data === 'object') {
            data = Object.values(response.data);
        }
        
        data.forEach(function(item) {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        
        select.html(options);
        select.prop('disabled', false);
    }).fail(function() {
        select.html('<option value="">Gagal memuat</option>');
    });
}

// Load kelurahan
function loadVillages(districtCode, selectId) {
    const select = $('#' + selectId);
    select.html('<option value="">Memuat...</option>');
    select.prop('disabled', true);
    
    $.get(API_BASE + '/kelurahan/' + districtCode, function(response) {
        let options = '<option value="">-- Pilih Kelurahan/Desa --</option>';
        let data = [];
        
        if (Array.isArray(response)) {
            data = response;
        } else if (response.data && Array.isArray(response.data)) {
            data = response.data;
        } else if (response.data && typeof response.data === 'object') {
            data = Object.values(response.data);
        }
        
        data.forEach(function(item) {
            options += `<option value="${item.code}">${item.name}</option>`;
        });
        
        select.html(options);
        select.prop('disabled', false);
    }).fail(function() {
        select.html('<option value="">Gagal memuat</option>');
    });
}

// ============================================
// EVENT HANDLERS
// ============================================

$(document).ready(function() {
    console.log('Form ready');
    
    // Load initial provinces
    loadProvinces('ktp_provinsi');
    loadProvinces('domisili_provinsi');
    
    // KTP Province Change
    $('#ktp_provinsi').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#ktp_provinsi_name').val(name);
        if (code) {
            loadRegencies(code, 'ktp_kota');
            $('#ktp_kota_name').val('');
            $('#ktp_kecamatan_name').val('');
            $('#ktp_kelurahan_name').val('');
        } else {
            $('#ktp_provinsi_name').val('');
            $('#ktp_kota').html('<option value="">-- Pilih Provinsi Dahulu --</option>').prop('disabled', true);
            $('#ktp_kecamatan').html('<option value="">-- Pilih Kota Dahulu --</option>').prop('disabled', true);
            $('#ktp_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // KTP Kota Change
    $('#ktp_kota').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#ktp_kota_name').val(name);
        if (code) {
            loadDistricts(code, 'ktp_kecamatan');
            $('#ktp_kecamatan_name').val('');
            $('#ktp_kelurahan_name').val('');
        } else {
            $('#ktp_kota_name').val('');
            $('#ktp_kecamatan').html('<option value="">-- Pilih Kota Dahulu --</option>').prop('disabled', true);
            $('#ktp_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // KTP Kecamatan Change
    $('#ktp_kecamatan').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#ktp_kecamatan_name').val(name);
        if (code) {
            loadVillages(code, 'ktp_kelurahan');
            $('#ktp_kelurahan_name').val('');
        } else {
            $('#ktp_kecamatan_name').val('');
            $('#ktp_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // Domisili Province Change
    $('#domisili_provinsi').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#domisili_provinsi_name').val(name);
        if (code) {
            loadRegencies(code, 'domisili_kota');
            $('#domisili_kota_name').val('');
            $('#domisili_kecamatan_name').val('');
            $('#domisili_kelurahan_name').val('');
        } else {
            $('#domisili_provinsi_name').val('');
            $('#domisili_kota').html('<option value="">-- Pilih Provinsi Dahulu --</option>').prop('disabled', true);
            $('#domisili_kecamatan').html('<option value="">-- Pilih Kota Dahulu --</option>').prop('disabled', true);
            $('#domisili_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // Domisili Kota Change
    $('#domisili_kota').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#domisili_kota_name').val(name);
        if (code) {
            loadDistricts(code, 'domisili_kecamatan');
            $('#domisili_kecamatan_name').val('');
            $('#domisili_kelurahan_name').val('');
        } else {
            $('#domisili_kota_name').val('');
            $('#domisili_kecamatan').html('<option value="">-- Pilih Kota Dahulu --</option>').prop('disabled', true);
            $('#domisili_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // Domisili Kecamatan Change
    $('#domisili_kecamatan').on('change', function() {
        const code = $(this).val();
        const name = $(this).find('option:selected').text();
        $('#domisili_kecamatan_name').val(name);
        if (code) {
            loadVillages(code, 'domisili_kelurahan');
            $('#domisili_kelurahan_name').val('');
        } else {
            $('#domisili_kecamatan_name').val('');
            $('#domisili_kelurahan').html('<option value="">-- Pilih Kecamatan Dahulu --</option>').prop('disabled', true);
        }
    });
    
    // KTP Kelurahan Change - capture name
    $('#ktp_kelurahan').on('change', function() {
        const name = $(this).find('option:selected').text();
        $('#ktp_kelurahan_name').val($(this).val() ? name : '');
    });
    
    // Domisili Kelurahan Change - capture name
    $('#domisili_kelurahan').on('change', function() {
        const name = $(this).find('option:selected').text();
        $('#domisili_kelurahan_name').val($(this).val() ? name : '');
    });
    
    $('#sama_ktp').on('change', function() {
        if ($(this).is(':checked')) {
            // Copy nilai dari KTP ke Domisili
            const ktpProv = $('#ktp_provinsi').val();
            const ktpKota = $('#ktp_kota').val();
            const ktpKec = $('#ktp_kecamatan').val();
            const ktpKel = $('#ktp_kelurahan').val();
            
            // Set provinsi dulu
            $('#domisili_provinsi').val(ktpProv);
            
            // Copy data dari select KTP ke Domisili tanpa AJAX untuk mencegah timeout/delay
            if (ktpProv) {
                $('#domisili_provinsi_name').val($('#ktp_provinsi_name').val());
                
                $('#domisili_kota').html($('#ktp_kota').html()).val(ktpKota);
                $('#domisili_kota_name').val($('#ktp_kota_name').val());
                
                $('#domisili_kecamatan').html($('#ktp_kecamatan').html()).val(ktpKec);
                $('#domisili_kecamatan_name').val($('#ktp_kecamatan_name').val());
                
                $('#domisili_kelurahan').html($('#ktp_kelurahan').html()).val(ktpKel);
                $('#domisili_kelurahan_name').val($('#ktp_kelurahan_name').val());
            }
            
            // Disable domisili fields
            $('#domisili_provinsi, #domisili_kota, #domisili_kecamatan, #domisili_kelurahan').prop('disabled', true);
            $('input[name="domisili_rt_rw"], textarea[name="domisili_alamat_detail"]').prop('disabled', true);
            
            // Copy RT/RW dan alamat
            $('input[name="domisili_rt_rw"]').val($('input[name="ktp_rt_rw"]').val());
            $('textarea[name="domisili_alamat_detail"]').val($('textarea[name="ktp_alamat_detail"]').val());
            
        } else {
            // Enable domisili fields
            $('#domisili_provinsi, #domisili_kota, #domisili_kecamatan, #domisili_kelurahan').prop('disabled', false);
            $('input[name="domisili_rt_rw"], textarea[name="domisili_alamat_detail"]').prop('disabled', false);
        }
    });
    
    // Submit Form
    $('#formAnggota').on('submit', function(e) {
        e.preventDefault();
        
        // Enable domisili fields if checkbox checked (agar nilai tetap terkirim)
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
            url: '{{ route("admin.anggota.store") }}',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
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
    
    // Show first step
    showStep(1);
});
</script>
@endpush
@endsection