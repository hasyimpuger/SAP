<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $guarded = ['id'];

    public function transaksi() {
    	return $this->hasMany('App\Transaksi', 'pelanggan_id', 'id');
    }
}
