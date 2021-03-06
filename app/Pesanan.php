<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'id', 'user_id', 'nama_pelanggan', 'alamat_pelanggan', 'created_at', 'updates_at'
    ];

    public function barang()
    {
        return $this->belongsToMany('App\Barang', 'pesanan_barang', 'barang_id', 'user_id')->withPivot('jumlah')->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->first();
    }
}
