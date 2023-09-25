<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengiriman',
        'biaya'
    ];

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
}
