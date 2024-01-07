@extends('layouts/app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Buku</title>
</head>
@section('content')
<main class="container">
    <section>
        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            {{-- by use csrf it is added security --}}
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Edit Buku</h1>
            </div>
            @if ($errors->any())
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
                    <label>Judul buku</label>
                    <input name="judul" type="text" value="{{$product->judul}}">
                    <label>Nama pengarang</label>
                    <input name="nama_pengarang" type="text" value="{{$product->nama_pengarang}}">
                    <label>Tahun terbit</label>
                    <input name="tahun_terbit" type="number" min="1900" max="2099" value="{{$product->tahun_terbit}}">
                </div>
                <div>
                    <label>Keterangan (optional)</label>
                    <textarea name="keterangan" cols="10" rows="5" value="{{$product->keterangan}}"></textarea>
                    <label>Gambar buku</label>
                    <img src="{{asset('images/' . $product->gambar)}}" alt="" class="img-product" id="file-preview" />
                    <input name="hidden_gambar_buku" type="hidden" value="{{$product->image}}">
                    <input name="gambar" type="file" accept="image/*" onchange="showFile(event)">
                </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                {{-- to get our book id --}}
                <input type="hidden" name="hidden_id" value="{{$product->id}}">
                <button>Simpan</button>
            </div>
        </form>
    </section>
</main>
{{-- javascript func to show the image preview --}}
<script>
    function showFile(event){
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('file-preview');
            output.src = dataURL;
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>

@endsection