<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecpos extends Model
{
    protected $table = 'escpos_setting';

    protected $fillable = [
        'ip',
        'nama_printer'
    ];
}
