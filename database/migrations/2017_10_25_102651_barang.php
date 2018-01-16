<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Barang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');   
            $table->string('nama_barang', 200);
            $table->integer('kategori_id')->unsigned();
            $table->integer('harga_beli')->unsigned();
            $table->integer('harga_jual')->unsigned();
            $table->integer('harga_reseller')->unsigned()->nullable();
            $table->integer('stok')->unsigned();
            $table->integer('distributor_id')->unsigned();
            $table->date('tgl_masuk');
            $table->text('barcode');
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
        Schema::dropIfExists('barang');
    }
}
