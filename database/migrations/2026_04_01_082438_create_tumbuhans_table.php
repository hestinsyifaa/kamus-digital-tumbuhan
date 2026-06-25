<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tumbuhan', function (Blueprint $table) {
            $table->id();

            // IDENTITAS
            $table->string('nama_tumbuhan')->unique();
            $table->string('nama_latin')->nullable();

            // KLASIFIKASI
            $table->string('jenis')->nullable(); // monokotil / dikotil

            // DESKRIPSI
            $table->text('deskripsi')->nullable();

            // LOKASIs
            $table->string('lokasi')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // MEDIA
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tumbuhan');
    }
};