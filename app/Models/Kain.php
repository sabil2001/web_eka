<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kain extends Model
{
    use HasFactory;
    protected $table = 'kains';
    protected $guarded = ['id'];
    
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
