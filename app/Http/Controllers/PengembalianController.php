<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Peminjaman;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Pengembalian',
            'header' => 'Pengembalian',
            'peminjaman' => Peminjaman::where('status_kembali', 0)->with('buku', 'siswa')->get(),
            'pengembalian' => Pengembalian::with('peminjaman.buku', 'peminjaman.siswa')->get()
        ];
        return view('pengembalian.index', $data);
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
        $buku = Buku::find($request->buku_id);
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'keterlambatan' => $request->keterlambatan,
            'denda' => $request->denda,
        ]);

        $buku->stok += 1;
        $buku->save();
        $peminjaman->status_kembali = 1;
        $peminjaman->save();

        Alert::success('Berhasil', 'Berhasil Proses Pengembalian');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengembalian $pengembalian)
    {
        //
    }

    public function getDetail($id) {
        $peminjaman = Peminjaman::with('buku', 'siswa')->where('status_kembali', 0)->find($id);
        return response()->json($peminjaman);
    }
}
