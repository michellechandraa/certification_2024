@extends('layouts/app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Pinjam</title>
</head>
@section('content')
<main class="container">
    <section>
            <div class="titlebar">
                <h1>Riwayat Pinjam</h1>
            </div>
            <div class="table">
                <div class="table-product-head">
                    <p>Nama Peminjam</p>
                    <p>Judul</p>
                    <p>Tanggal Pinjam</p>
                    <p>Tanggal Kembali</p>
                    <p>Status</p>
                </div>
                <div class="table-product-body">
                    @if (count($riwayat) > 0)
                        @foreach ($riwayat as $riwayats)
                            <p>{{$riwayats->anggota->nama}}</p>
                            <p>{{$riwayats->buku->judul}}</p>
                            <p>{{$riwayats->tgl_pinjam}}</p>
                            <p>{{$riwayats->tgl_kembali}}</p>
                            {{-- FOR THE UPDATE TO RETURN THE BOOK --}}
                            <form action="{{route('riwayat.update',['riwayat' => $riwayats->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <span class="">
                                    <input type="checkbox" name="status_kembali" {{ $riwayats->status_kembali == 'kembali' ? 'checked' : '' }}>
                                    <label>{{$riwayats->status_kembali}}</label>
                                    <button type="submit">update</button>
                                </span>
                            </form>
                        @endforeach
                    @else
                        
                    @endif
                    
                </div>
            </div>
    </section>
</main>
@endsection