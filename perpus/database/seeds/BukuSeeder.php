<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {

            // insert data ke table buku menggunakan Faker
            DB::table('buku')->insert([
                'isbn' => $faker->numberBetween(111111, 999999),
                'judul' => $faker->name,
                'id_penerbit' => $faker->numberBetween(1, 5),
                'id_pengarang' => $faker->numberBetween(1, 3),
                'id_katalog' => $faker->numberBetween(1, 3),
                'qty_stok' => $faker->numberBetween(5, 20),
                'harga_pinjam' => $faker->numberBetween(5000, 2000)
            ]);
        }
    }
}
