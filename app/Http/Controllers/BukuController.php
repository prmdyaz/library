<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Buku',
            'header' => 'Data Buku'
        ];

        return view('buku.index', $data)->withBuku(Buku::all()->where('deleted', 0));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'no_isbn' => 'required|numeric',
            'pengarang' => 'required',
            'halaman' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'penerbit' => 'required',
            'stok' => 'required|numeric',
        ]);

        $file = $request->file('gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        $file->move('img_book', $nama_gambar);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->no_isbn = $request->no_isbn;
        $buku->pengarang = $request->pengarang;
        $buku->halaman = $request->halaman;
        $buku->gambar = $nama_gambar;
        $buku->penerbit = $request->penerbit;
        $buku->stok = $request->stok;
        $buku->deleted = 0;
        $buku->save();

        Alert::success('Berhasil', 'Berhasil tambah data buku');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return response()->json($buku);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return response()->json($buku);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        if ($request->hasFile('gambar')) {
            File::delete('img_book/' . $buku->gambar);
            $file = $request->file('gambar');
            if (!$buku->gambar) {
                $buku->gambar = time() . '.' . $file->getClientOriginalExtension();
            }
            $file->move('img_book', $buku->gambar);
        }

        $buku->judul = $request->judul;
        $buku->no_isbn = $request->no_isbn;
        $buku->pengarang = $request->pengarang;
        $buku->halaman = $request->halaman;
        $buku->penerbit = $request->penerbit;
        $buku->stok = $request->stok;
        $buku->save();

        Alert::success('Berhasil', "Berhasil Perbarui Buku");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        File::delete('img_book/' . $buku->gambar);
        $buku->deleted = 1;
        $buku->gambar = NULL;
        $buku->save();

        Alert::success("Berhasil", "Berhasil Hapus data buku");
        return redirect()->back();
    }

    public function validateAddBook(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'no_isbn' => 'required|numeric',
            'pengarang' => 'required',
            'halaman' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'penerbit' => 'required',
            'stok' => 'required|numeric',
        ]);

        $data = [
            'is-valid' => true
        ];

        return response()->json($data);
    }

    public function validateEditBook(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'no_isbn' => 'required|numeric',
            'pengarang' => 'required',
            'halaman' => 'required|numeric',
            'penerbit' => 'required',
            'stok' => 'required|numeric',
        ]);

        $data = [
            'is-valid' => true
        ];

        return response()->json($data);
    }
}
