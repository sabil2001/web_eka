<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    protected $table = 'produksis';
    protected $guarded = ['id'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function verifikasi()
    {
        return $this->hasMany(Verifikasi::class);
    }
}
