<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show the main view
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 5;

        if(!empty($keyword)) {
            $products = Book::where('judul', 'LIKE', "%$keyword%")
                        ->orWhere('nama_pengarang', 'LIKE', "%$keyword")
                        ->latest()->paginate($perPage);
        }
        else {
            $products = Buku::latest()->paginate($perPage);
        }
        return view('products.home', ['products'=> $products])->with('1',(request()->input('page', 1) -1) *5);
    }

    // Show the view to input a book
    public function create(){
        return view('products.input_buku');
    }

    // Save a book in database
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'nama_pengarang' => 'required',
            'tahun_terbit' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2028'
        ]);

        $buku = new Buku;

        $file_name = time() . '.' . request()->gambar->getClientOriginalExtension();
        request()->gambar->move(public_path('images'), $file_name);

        $buku->judul = $request->judul;
        $buku->nama_pengarang = $request->nama_pengarang;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->keterangan = $request->keterangan;
        $buku->gambar = $file_name;

        $buku->save();
        return redirect()->route('products.index')->with('success', 'Buku berhasil diinput');
    }

    // Show the view to edit a book
    public function edit($id) {
        $product = Buku::findOrFail($id);
        return view('products.edit_buku', ['product'=>$product]);
    }

    // Update book data in database
    public function update(Request $request, Buku $buku) {
        $request->validate([
            'judul' => 'required',
        ]);

        $file_name = $request->hidden_product_image;

        if($request->image != '') {
            $file_name = time() . '.' . request()->gambar->getClientOriginalExtension();
        request()->gambar->move(public_path('images'), $file_name);
        }

        $buku = Buku::find($request->hidden_id);

        $buku->judul = $request->judul;
        $buku->nama_pengarang = $request->nama_pengarang;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->keterangan = $request->keterangan;
        $buku->gambar = $file_name;

        $buku->save();

        return redirect()->route('products.index')->with('success', 'Buku berhasil di edit');
    }

    // Delete a book in database
    public function destroy($id){
        $product = Buku::findOrFail($id);
        $image_path = public_path()."/images/";
        $image = $image_path. $product->gambar;
        if(file_exists($image)) {
            @unlink($image);
        }
        $product->delete();
        return redirect('products')->with('success','Buku berhasil di hapus');
    }
}
