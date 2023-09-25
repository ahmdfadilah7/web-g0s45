<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_website',
        'biaya_admin',
        'saldo',
        'email',
        'no_telp',
        'alamat',
        'logo',
        'favicon',
        'google_maps',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'judul_header_home',
        'bg_header_home',
        'bg_header_page',
    ];
}
