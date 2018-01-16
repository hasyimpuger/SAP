<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->char('invoice_id', 10);
            $table->date('tgl_transaksi');
            $table->integer('qty')->unsigned();
            $table->integer('pelanggan_id')->unsigned()->nullable();
            $table->integer('total_bayar')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('kembalian')->unsigned();
            $table->integer('jumlah_bayar')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
