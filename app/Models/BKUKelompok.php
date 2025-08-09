<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKUKelompok extends Model
{
    use HasFactory;

    public $table = "kelompok";

    protected $fillable = [
        'id', 'id_akun','id_kelompok','kode_kelompok', 'uraian_kelompok'
    ];

}
