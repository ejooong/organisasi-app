<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kartu_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layout');
            $table->string('file_path'); // path ke file layout
            $table->string('tipe_file'); // pdf/html/image
            $table->json('field_positions')->nullable(); // posisi field di layout
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kartu_layouts');
    }
};