<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user (jika anggota punya akun)
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Data Pokok
            $table->string('no_kartu', 16)->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('pendidikan_terakhir');
            $table->string('pekerjaan');
            
            // Alamat KTP
            $table->string('ktp_provinsi_code', 2);
            $table->string('ktp_provinsi_name');
            $table->string('ktp_kota_code', 4);
            $table->string('ktp_kota_name');
            $table->string('ktp_kecamatan_code', 7);
            $table->string('ktp_kecamatan_name');
            $table->string('ktp_kelurahan_code', 10);
            $table->string('ktp_kelurahan_name');
            $table->string('ktp_rt_rw', 10)->nullable();
            $table->text('ktp_alamat_detail');
            
            // Alamat Domisili
            $table->string('domisili_provinsi_code', 2);
            $table->string('domisili_provinsi_name');
            $table->string('domisili_kota_code', 4);
            $table->string('domisili_kota_name');
            $table->string('domisili_kecamatan_code', 7);
            $table->string('domisili_kecamatan_name');
            $table->string('domisili_kelurahan_code', 10);
            $table->string('domisili_kelurahan_name');
            $table->string('domisili_rt_rw', 10)->nullable();
            $table->text('domisili_alamat_detail');
            
            // Kontak
            $table->string('no_wa', 15);
            $table->string('email')->nullable();
            
            // Keluarga
            $table->integer('jml_keluarga_inti')->default(0);
            $table->integer('jml_keluarga_serumah')->default(0);
            
            // Ketertarikan (disimpan sebagai JSON)
            $table->json('ketertarikan')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->timestamp('registered_at')->nullable();
            
            // Soft deletes & timestamps
            $table->softDeletes();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('registered_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggotas');
    }
};