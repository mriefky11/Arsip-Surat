<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengirim');
            $table->integer('id_penerima');
            $table->string('nomor_surat');
            $table->string('tanggal_dikirim');
            $table->string('pengirim');
            $table->string('tanggal_diterima');
            $table->string('diterima_oleh');
            $table->text('isi_disposisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
