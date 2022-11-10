<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Perpustakaan",
            'header' => "Dashboard",
            'buku' => count(Buku::where('deleted', 0)->get()),
            'siswa' => count(Siswa::all()),
            'peminjaman' => count(Peminjaman::all()),
            'pengembalian' => count(Pengembalian::all())
        ];

        return view('index', $data)
            ->withLast(Peminjaman::orderBy('id', 'desc')->take(5)->with('buku', 'siswa')->get());
    }

    public function detail($id) {
        $peminjaman = Peminjaman::with('siswa', 'buku', 'pengembalian')->find($id);

        return response()->json($peminjaman, 200);
    }
}
