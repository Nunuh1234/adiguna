<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'id', 'kategori_id', 'kode', 'nama', 'keterangan', 'harga', 'stok', 'created_at', 'updated_at'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id')->first();
    }
}
