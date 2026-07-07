<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wilayah_cache', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['province', 'regency', 'district', 'village']);
            $table->string('code')->unique();
            $table->string('parent_code')->nullable()->index();
            $table->string('name');
            $table->json('meta_data')->nullable();
            $table->timestamp('cached_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wilayah_cache');
    }
};