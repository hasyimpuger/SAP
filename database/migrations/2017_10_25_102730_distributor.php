<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Distributor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_distributor', 200);
            $table->text('alamat');
            $table->string('telp', 13);
            $table->integer('kode_pos')->unsigned();
            $table->string('photo', 200);
            $table->text('deskripsi');
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
        Schema::dropIfExists('distributor');
    }
}
