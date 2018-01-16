<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_id',
        'jumlah_bayar',
        'tgl_transaksi',
        'qty',
        'total_bayar',
        'barang_id',
        'kembalian',
    ];

    public $timestamps = false;

    public function barang() {
        return $this->belongsTo('App\Barang');
    }
}
