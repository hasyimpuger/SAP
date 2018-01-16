<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';

    protected $fillable = [
    	'nama_toko',
    	'alamat',
    	'email',
    	'telp',
    	'deskripsi'
    ];

    public $timestamps = false;
}
