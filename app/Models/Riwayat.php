<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ['anggota_id', 'buku_id', 'status_kembali', 'tgl_pinjam', 'tgl_kembali'];
    
    public $table = "riwayat";


    // for the foreign key
    public function anggota() {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
