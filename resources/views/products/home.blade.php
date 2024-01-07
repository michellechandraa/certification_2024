@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>
</head>
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Library Catalog</h1>
            <div class="btn-container">
                <a href="{{ route('products.create') }}" class="btn-link">Input Buku</a>
                <a href="{{ route('riwayat.create')}}" class="btn-link">Riwayat Pinjam</a>
                <a href="{{ route('pinjam.create')}}" class="btn-link">Pinjam</a>
            </div>
        </div> 
        {{-- FOR THE SEARCH BAR --}}
        <form action="{{route('products.index')}}" method="GET" accept-charset="UTF-8" role="search">
            <div>
                <input name="search" type="text" placeholder="Search Catalog..." value="{{request('search')}}">
            </div>
        </form>
        <div class="table">
            <div class="table-product-head">
                <p>Gambar</p>
                <p>Judul</p>
                <p>Pengarang</p>
                <p>Tahun</p>
                <p>Aksi</p>
            </div>
            <div class="table-product-body">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                    <img src="{{asset('images/' . $product->gambar)}}">
                    <p>{{$product->judul}}</p>
                    <p>{{$product->nama_pengarang}}</p>
                    <p>{{$product->tahun_terbit}}</p>
                    <div>     
                        <a href="{{route('products.edit', $product->id)}}" class="btn-link btn btn-success">
                            <i class="fas fa-pencil-alt" ></i> 
                        </a>
                        {{-- DELETE THE BOOK --}}
                        <form action="{{route('products.destroy', $product->id)}}" method="POST">
                            @method('delete')
                            @csrf
                                <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                        </form>
                    </div>
                    @endforeach
                @else
                    <p>Buku tidak ditemukan</p>
                @endif
            </div>
        </div>
        <div class="table-paginate">
            {{$products->links('layouts.pagination')}}
        </div>
    </section>
</main> 

{{-- FOR THE ALERT OF DELETE THE BOOK --}}
<script>
    window.deleteConfirm = function(e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection