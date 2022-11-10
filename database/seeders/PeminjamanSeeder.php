<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use Faker\Factory as Faker;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create();

        for($i= 1; $i<=5; $i++) {
            Peminjaman::insert([
                'tanggal_pinjam' => $faker->dateTime(),
                'tanggal_kembali' => $faker->dateTime(),
                'buku_id' =>$faker->numberBetween(1, 5),
                'durasi_pinjam_hari' => $faker->numberBetween(5, 10),
                'status_kembali' => $faker->numberBetween(0, 1),
                'siswa_id' => $faker->numberBetween(1 ,5)
            ]);
        };
    }
}
