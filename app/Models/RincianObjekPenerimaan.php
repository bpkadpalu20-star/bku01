<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianObjekPenerimaan extends Model
{
    use HasFactory;

    public $table = "rincianobjekPenerimaan";

    protected $fillable = [
        'id','id_op', 'id_op', 'id_opd', 'id_akun', 'id_kelompok', 'kd_jenis', 'kd_objek', 'kd_rincianobjek', 'kode_rincianobjek', 'nilai_pagurincian', 'nilai_realisasirincian', 'bulan_id', 'bulan'



    ];
}
