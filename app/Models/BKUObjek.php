<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKUObjek extends Model
{
    use HasFactory;

    public $table = "objek";

    protected $fillable = [
        'id', 'kode_objek', 'kode_jenis', 'id_akun', 'id_kelompok', 'id_jenis', 'id_objek', 'uraian_objek'

    ];
}
