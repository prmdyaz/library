<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Buku;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Peminjaman',
            'header' => 'Peminjaman',
            'siswa' => Siswa::all(),
            'buku' => Buku::all()->where('deleted', 0),
            'peminjaman' => Peminjaman::with('buku', 'siswa')->get()
        ];
        return view('peminjaman.index', $data);
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
        $tanggal_pinjam = explode("/", $request->tanggal_pinjam);
        $tanggal_pinjam = "$tanggal_pinjam[2]-$tanggal_pinjam[1]-$tanggal_pinjam[0]";
        $tanggal_kembali = explode("/", $request->tanggal_kembali);
        $tanggal_kembali = "$tanggal_kembali[2]-$tanggal_kembali[1]-$tanggal_kembali[0]";


        $peminjaman = new Peminjaman();
        $peminjaman->siswa_id = $request->siswa_id;
        $peminjaman->buku_id = $request->buku_id;
        $peminjaman->tanggal_pinjam = $tanggal_pinjam;
        $peminjaman->tanggal_kembali = $tanggal_kembali;
        $peminjaman->durasi_pinjam_hari = $request->durasi_pinjam_hari;
        $peminjaman->status_kembali = 0;
        $peminjaman->save();

        $buku = Buku::find($request->buku_id);
        $buku->stok -= 1;
        $buku->save();

        $siswa = Siswa::find($request->siswa_id);
        $siswa->total_pinjam = count(Peminjaman::where('siswa_id', $request->siswa_id)->get());
        $siswa->save();

        Alert::success('Berhasil', 'Peminjaman berhasil dibuat');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok += 1;
        $buku->save();

        $peminjaman->delete();

        $siswa = Siswa::find($peminjaman->siswa_id);
        $siswa->total_pinjam = count(Peminjaman::where('siswa_id', $peminjaman->siswa_id)->get());
        $siswa->save();


        Alert::success('Berhasil', 'Berhasil Membatalkan Peminjaman');
        return redirect()->back();
    }

    public function validatePeminjaman(Request $request)
    {
        return $this->validate($request, [
            'siswa_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'required|date_format:d/m/Y|after_or_equal:today',
            'tanggal_kembali' => 'required|date_format:d/m/Y|after:tanggal_pinjam',
        ]);
    }

    public function getDetail(Request $request)
    {
        $data = [
            "buku" => Buku::find($request->buku_id),
            "siswa" => Siswa::find($request->siswa_id),
            "tanggal_pinjam" => $request->tanggal_pinjam,
            "tanggal_kembali" => $request->tanggal_kembali,
            "durasi" => $request->durasi_pinjam_hari
        ];
        return response()->json($data, 200);
    }
}
