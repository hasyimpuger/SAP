<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $fillable = [
        'tgl_pemasukan',
        'jumlah_uang',
        'keterangan',
        'invoice_id'
    ];

    public $timestamps = false;
}
