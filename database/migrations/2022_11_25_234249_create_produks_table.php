<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->string('foto_produk');
            $table->string('kategori');
            $table->string('size');
            $table->integer('lebar_dada')->nullable();
            $table->integer('lebar_bahu')->nullable();
            $table->integer('panjang_badan')->nullable();
            $table->integer('panjang_tangan')->nullable();
            $table->integer('lingkar_lengan_atas')->nullable();
            $table->integer('lingkar_lengan_bawah')->nullable();
            $table->integer('panjang_luar')->nullable();
            $table->integer('panjang_dalam')->nullable();
            $table->integer('lebar_pinggang')->nullable();
            $table->integer('lebar_pergelangan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_laku');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
