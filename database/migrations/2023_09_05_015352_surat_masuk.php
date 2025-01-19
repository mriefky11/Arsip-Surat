<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('surat_keluar', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('nomor_surat')->unique();
    //         $table->string('pengirim');
    //         $table->string('penerima');
    //         $table->string('tembusan')->nullable();
    //         $table->string('file_pdf')->nullable();
    //         $table->text('perihal');
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->unsignedBigInteger('pengirim_id');
            $table->string('pengirim');
            $table->text('penerima_ids');
            $table->string('tembusan')->nullable();
            $table->string('file_pdf')->nullable();
            $table->text('perihal');
            $table->timestamps();

            $table->foreign('pengirim_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
