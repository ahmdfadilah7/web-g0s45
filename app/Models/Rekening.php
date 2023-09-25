<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_rekening',
        'no_rekening',
        'bank'
    ];

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
}
