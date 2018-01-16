<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_pengeluaran',
        'jumlah_uang',
        'keterangan'
    ];

    public $timestamps = false;
}
