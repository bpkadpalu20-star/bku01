<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    use HasFactory;

    public $table = "tblbulan";

    protected $fillable = [
        'id', 'nama_bulan', 'nilai_rincian', 'nilai_rinciansub', 'aktif'
    ];
}
