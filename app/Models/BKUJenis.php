<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKUJenis extends Model
{
    use HasFactory;

    public $table = "jenis";

    protected $fillable = [
        'id', 'kode_jenis', 'kode_kelompok', 'id_akun', 'id_kelompok', 'id_jenis', 'uraian_jenis'

    ];

}
