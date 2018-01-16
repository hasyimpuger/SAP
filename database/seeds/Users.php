<?php

use App\Kategori;
use App\Toko;
use App\User;
use Illuminate\Database\Seeder;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'level' =>  'admin'
        ]);

        $users = User::create([
            'username' => 'gudang',
            'password' => bcrypt('gudang'),
            'level' =>  'gudang'
        ]);

        $users = User::create([
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'level' =>  'kasir'
        ]);

        $toko = Toko::create([
            'nama_toko' => 'toko bagus',
            'alamat' => 'Mojokerto, Jl. mayjend H soemadi',
            'email' => 'toko_bagus@gamil.com',
            'telp' => '085707799317',
            'deskripsi' => 'menjual makanan dan minuman',
            'photo' => ''
        ]);

        $kategori = Kategori::create([
            'kategori' => 'makanan'
        ]);
    }
}
