<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'keranjangs';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
