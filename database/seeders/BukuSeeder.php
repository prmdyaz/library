<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
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
            Buku::insert([
                'judul' => $faker->state,
                'no_isbn' => $faker->numberBetween(2342402240, 3490349090),
                'pengarang' => $faker->name,
                'halaman' =>$faker->numberBetween(30, 599),
                'penerbit' => $faker->name,
                'stok' => $faker->numberBetween(30, 100),
                'deleted' => '0'
            ]);
        };
    }
}
