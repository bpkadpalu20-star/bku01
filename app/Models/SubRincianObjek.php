<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRincianObjek extends Model
{
    use HasFactory;

    public $table = "sub_rincianobjek";

    protected $fillable = [
        'id', 'id_akun', 'id_kelompok', 'id_jenis', 'id_objek', 'id_rincian_objek', 'id_sub_Rincian_objek', 'kode_subrincianobjek', 'uraian_subrincianobjek'
    ];
}
