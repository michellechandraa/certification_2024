<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Show the view riwayat peminjaman
    public function create() {
        $riwayat = Riwayat::orderby('tgl_pinjam')->get();
        return view('pinjam.riwayat_pinjam', ['riwayat' => $riwayat]);
    }

    // Update status_kembali data in database
    public function update(Request $request, Riwayat $riwayat)
    {
        $riwayat->update([
            'status_kembali' => $request->has('status_kembali') ? 'kembali' : 'dipinjam',
        ]);

        return redirect()->route('riwayat.create')->with('success', 'Status updated successfully.');
    }
}
