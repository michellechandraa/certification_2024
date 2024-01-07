<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    // Show the view to input a peminjaman
    public function create() {
        return view('pinjam.pinjam_buku');
    }

    // Save a peminjaman in database
    public function store(Request $request) {

        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'judul' => 'required',
            'tgl_pinjam' => 'required'
            
        ]);


        $anggota = new Anggota;

        $anggota->nama = $request->nama;
        $anggota->no_hp = $request->no_hp;

        $anggota->save();
       
        $riwayat = new Riwayat;

        $riwayat->anggota_id = $anggota->id;
        $riwayat->buku_id = Buku::where('judul', $request->judul)->first()->id;
        $riwayat->status_kembali = 'dipinjam';
        $riwayat->tgl_pinjam = $request->tgl_pinjam;
        $riwayat->tgl_kembali = \Carbon\Carbon::now()->addDays(7)->format('Y-m-d');

        $riwayat->save();
        
        return redirect()->route('products.index');
    }
}
