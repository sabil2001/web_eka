<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pesanans';

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function kain()
    {
        return $this->belongsTo(Kain::class);
    }

    // public function produksi()
    // {
    //     return $this->hasMany(Produksi::class);
    // }
}
