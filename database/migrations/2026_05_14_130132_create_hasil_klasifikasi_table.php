<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_klasifikasi', function (Blueprint $table) {
            $table->id();

            // input user
            $table->string('input_type'); // teks / gambar
            $table->string('input_name')->nullable(); // isi teks / nama file

            // hasil AI
            $table->string('model'); // naive_bayes / yolov26
            $table->string('hasil'); // monokotil / dikotil

            // confidence model AI
            $table->float('confidence')->nullable();

            // validasi admin
            $table->string('status')->default('pending'); // valid / tidak valid / pending
            $table->string('validator')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_klasifikasi');
    }
};