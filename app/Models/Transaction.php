<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sepatu',
        'id_user',
        'jumlah_sepatu',
        'total_harga',
        'tanggal_pesan'
    ];

    public function zalora()
    {
        return $this->belongsto(Zalora::class);
    }

    public function user()
    {
        return $this->belongsto(User::class);
    }
}
