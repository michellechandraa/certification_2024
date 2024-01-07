{{-- to get the layout --}}
@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinjam Buku</title>
</head>
@section('content')
<main class="container">
    <section>
        <form action="{{route('pinjam.store')}}" method="POST">
            @csrf
            <div class="titlebar">
                <h1>Pinjam Buku</h1>
            </div>
            @if ($errors->any)
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div>
                    <label>Nama peminjam</label>
                    <input name="nama" type="text">
                    <label> No HP (WA)</label>
                    <input name="no_hp" type="text">
                    <label>Judul buku yang dipinjam</label>
                    <input name="judul" type="text">
                </div>
                <div>
                    <label>Tanggal pinjam</label>
                    <input name="tgl_pinjam" type="date">
                    <hr>
                    <label>Tanggal kembali (h+7)</label>
                    <input name="tgl_kembali" type="date" readonly>
                </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <button>Simpan</button>
            </div>
        </form>
    </section>        
</main>    

{{-- SCRIPT FOR THE TGL_KEMBALI AUTO GENERATE --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tglPinjamInput = document.querySelector('input[name="tgl_pinjam"]');
        const tglKembaliInput = document.querySelector('input[name="tgl_kembali"]');

        function updateTanggalKembali() {
            const selectedDate = new Date(tglPinjamInput.value);
            if (!isNaN(selectedDate.getTime())) {
                selectedDate.setDate(selectedDate.getDate() + 7);
                const formattedDate = selectedDate.toISOString().split('T')[0];
                tglKembaliInput.value = formattedDate;
            }
        }

        // Change the event listener to 'change'
        tglPinjamInput.addEventListener('change', updateTanggalKembali);
    });
</script>



@endsection