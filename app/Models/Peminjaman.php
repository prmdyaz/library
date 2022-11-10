<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Pengembalian;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $guarded = [];

    public function buku() {
        return $this->belongsTo(Buku::class);
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function pengembalian() {
        return $this->hasOne(Pengembalian::class);
    }
}
