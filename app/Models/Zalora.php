<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zalora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_Sepatu',
        'deskripsi',
        'harga',
        'stock_sepatu',
        'harga'
    ];

    public function zalora()
    {
        return $this->hasMany(Transaction::class);
    }

}
