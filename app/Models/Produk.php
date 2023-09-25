<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategoriproduk_id',
        'nama',
        'slug',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
        'gambar_1',
        'gambar_2',
        'gambar_3',
        'gambar_4',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategoriproduk(): BelongsTo
    {
        return $this->belongsTo(KategoriProduk::class, 'kategoriproduk_id', 'id');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'produk_id', 'id');
    }
}
