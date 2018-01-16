<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'distributor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_distributor',
        'alamat',
        'telp',
        'kode_pos',
        'photo',
        'deskripsi'
    ];

    public $timestamps = false;
}
