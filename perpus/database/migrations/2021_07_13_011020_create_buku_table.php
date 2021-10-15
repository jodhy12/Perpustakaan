<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('judul', 64);
            $table->unsignedBigInteger('id_penerbit');
            $table->unsignedBigInteger('id_pengarang');
            $table->unsignedBigInteger('id_katalog');
            $table->integer('qty_stok');
            $table->integer('harga_pinjam');
            $table->timestamps();

            // Relasi dengan Tabel Penerbit, Pengarang, dan Katalog
            $table->foreign('id_penerbit')->references('id')->on('penerbit');
            $table->foreign('id_pengarang')->references('id')->on('pengarang');
            $table->foreign('id_katalog')->references('id')->on('katalog');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
