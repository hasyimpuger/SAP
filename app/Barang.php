<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'harga_beli',
        'harga_jual',
        'distributor_id',
        'stok',
        'tgl_masuk',
        'barcode'
    ];

    public $timestamps = false;

    public function kategori() {
        return $this->belongsTo('App\Kategori');
    }

    public function distributor() {
        return $this->belongsTo('App\Distributor');
    }

    public function transaksi() {
        return $this->hasOne('App\Transaksi');
    }

}
