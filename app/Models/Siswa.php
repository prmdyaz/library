<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $guarded = [];

    public function peminjamans() {
        return $this->hasMany(Peminjaman::class);
    }
}
