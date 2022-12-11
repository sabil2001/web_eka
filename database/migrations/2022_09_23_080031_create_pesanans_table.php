<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id');
            $table->foreignId('produk_id');
            $table->foreignId('kain_id');
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
            $table->integer('total_barang');
            $table->integer('total_barang_jadi')->nullable();
            $table->integer('total_kain_digunakan')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('status');
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
        Schema::dropIfExists('pesanans');
    }
};
