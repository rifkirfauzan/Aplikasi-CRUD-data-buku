<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::latest()->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'judul_buku'     => 'required',
        'pengarang'   => 'required',
        'penerbit'   => 'required',
        'image'     => 'required|image|mimes:png,jpg,jpeg'
    ]);

    //upload image
    $image = $request->file('image');
    $image->storeAs('public/bukus', $image->hashName());

    $buku = Buku::create([
        'judul_buku'     => $request->judul_buku,
        'pengarang'   => $request->pengarang,
        'penerbit' => $request->penerbit,
        'image'     => $image->hashName()
    ]);

    if($buku){
        //redirect dengan pesan sukses
        return redirect()->route('buku.index')->with(['success' => 'Data Buku Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('buku.index')->with(['error' => 'Data Buku Gagal Disimpan!']);
    }
}

public function edit(Buku $buku)
{
    return view('buku.edit', compact('buku'));
}

public function update(Request $request, Buku $buku)
{
    $this->validate($request, [
        'judul_buku'     => 'required',
        'pengarang'   => 'required',
        'penerbit'   => 'required',
    ]);

    //get data Buku by ID
    $buku = Buku::findOrFail($buku->id);

    if($request->file('image') == "") {

        $buku->update([
             'judul_buku'     => $request->judul_buku,
        'pengarang'   => $request->pengarang,
        'penerbit' => $request->penerbit,
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/bukus/'.$buku->image);

        //upload new image
        $image = $request->file('image');
        $image->storeAs('public/bukus', $image->hashName());

        $buku->update([
            'judul_buku'     => $request->judul_buku,
            'pengarang'   => $request->pengarang,
            'penerbit' => $request->penerbit,
            'image'     => $image->hashName()
        ]);

    }

    if($buku){
        //redirect dengan pesan sukses
        return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('buku.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}


public function destroy($id)
{
  $buku = Buku::findOrFail($id);
  Storage::disk('local')->delete('public/bukus/'.$buku->image);
  $buku->delete();

  if($buku){
     //redirect dengan pesan sukses
     return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('buku.index')->with(['error' => 'Data Gagal Dihapus!']);
  }
}



}
