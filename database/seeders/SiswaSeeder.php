<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
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
            Siswa::insert([
                'nama' => $faker->name,
                'denda' => $faker->numberBetween(5000, 100000),
                'total_pinjam' =>$faker->numberBetween(0, 5),
                'email' => $faker->email,
                'no_hp' => $faker->phoneNumber
            ]);
        };

    }
}
