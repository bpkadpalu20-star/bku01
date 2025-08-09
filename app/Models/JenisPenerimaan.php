<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPenerimaan extends Model
{
    use HasFactory;

    public $table = "jenispenerimaan";

    protected $fillable = [
        'kode_jenis','kode_kelompok', 'id_opd','id_kelompok', 'kd_jenis'

    ];

}
