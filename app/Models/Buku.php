<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'nama_pengarang', 'tahun_terbit', 'keterangan', 'gambar'];
    public $table = "buku";
}
