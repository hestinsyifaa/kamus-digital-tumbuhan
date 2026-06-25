<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();

            // jenis aktivitas
            $table->string('tipe'); 
            // contoh: klasifikasi, admin_action, model_usage

            // aksi yang dilakukan
            $table->string('aksi');
            // contoh: predict, insert, update, delete

            // deskripsi detail aktivitas
            $table->text('deskripsi')->nullable();

            // model yang dipakai (YOLO / MNB)
            $table->string('model_used')->nullable();

            // siapa yang melakukan (admin/user)
            $table->string('user')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};