<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $table = 'merchandises';

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'gambar',
        'nama_barang',
        'event_terkait',
        'harga',
        'stok',
    ];
}
