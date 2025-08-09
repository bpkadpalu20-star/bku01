<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKUSubrincianobjek extends Model
{
    use HasFactory;

    public $table = "sub_rincianobjek";

    protected $fillable = [
        'id', '	kode_subrincianobjek', '	kode_rincianobjek', '	id_akun', '	id_kelompok', '	id_jenis', '	id_objek', '	id_rincianobjek', '	id_subrincianobjek', '	uraian_subrincianobjek'



    ];
}
