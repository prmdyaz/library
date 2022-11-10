<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Peminjaman;

class Buku extends Model
{
    use HasFactory;

    public function peminjamans() {
        return $this->HasMany(Peminjaman::class);
    }
}
