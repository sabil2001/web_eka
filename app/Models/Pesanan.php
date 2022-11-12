<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pesanans';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }
}
