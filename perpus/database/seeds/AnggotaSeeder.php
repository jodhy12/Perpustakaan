<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            // insert data ke table anggota menggunakan Faker
            DB::table('anggota')->insert([
                'nama' => $faker->name,
                'sex' => $faker->randomElement(["P", "L"]),
                'telp' => $faker->numberBetween(11111, 99999),
                'alamat' => $faker->address,
                'email' => $faker->email
            ]);
        }
    }
}
