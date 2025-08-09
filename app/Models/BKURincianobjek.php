<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKURincianobjek extends Model
{
    use HasFactory;

    public $table = "rincian_objek";

    protected $fillable = [
        'id', 'kode_rincianobjek', 'kode_objek', 'id_akun', 'id_kelompok', 'id_jenis', 'id_objek', 'id_rincianobjek', 'uraian_rincianobjek'


    ];
}
