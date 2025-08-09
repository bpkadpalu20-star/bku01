<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeRekening extends Model
{
    use HasFactory;

    public $table = "kode_rekening";

    protected $fillable = [
        'kode_subrincianobjek', 'kode_rincianobjek', 'kode_objek', 'kode_jenis','kode_kelompok', 'kd_akun', 'kd_kelompok', 'kd_jenis', 'kd_objek', 'kd_rincianobjek', 'kd_subrincianobjek', 'id_akun', 'id_kelompok', 'id_jenis', 'id_objek', 'id_rincianobjek', 'id_subrincianobjek'
    ];

}
