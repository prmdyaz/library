<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Siswa',
            'header' => 'Data Siswa'
        ];
        return view('siswa.show', $data)->withSiswa(Siswa::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Siswa',
            'header' => 'Tambah Siswa'
        ];

        return view('siswa.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:siswas,email|email',
            'no_hp' => 'required|numeric|unique:siswas,no_hp',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'denda' => 0,
            'total_pinjam' => 0,
        ]);

        Alert::success('Berhasil', 'Berhasil Tambah Data Siswa');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $data = [
            'title' => 'Siswa',
            'header' => 'Edit Siswa'
        ];

        return view('siswa.edit', $data)->withSiswa($siswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:siswas,email,'.$siswa->id,
            'no_hp' => 'required|numeric|unique:siswas,no_hp,'.$siswa->id,
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        Alert::success("Berhasil", "Berhasil Edit Data");
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        Alert::success('Berhasil', 'Berhasil Hapus Data Siswa');
        return redirect()->back();
    }
}
