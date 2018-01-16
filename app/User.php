<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Barang;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [ 
        'username',
        'password',
        'level'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    public function getStok() {
        $stok = Barang::where('stok', '<=', 3)->take(5)->get();

        return $stok;
    }

    public function countStok() {
        $countStok = Barang::where('stok', '<=', 3)->get();

        return $countStok;
    }

    public function getToko() {
        $toko = Toko::first();
        return $toko;
    }

    public function getPhoto() {
        $toko = Toko::first();
        $photo = $toko->photo;
        return $photo;
    }
}
