<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekPenerimaan extends Model
{
    use HasFactory;

    public $table = "objekpenerimaan";

    protected $fillable = [
        'id','id_jp', '	id_opd', '	id_akun','	id_kelompok', '	kd_jenis', 'kd_objek', 'kode_objek', 'nilai_paguobjek', 'nilai_realisasiobjek', 'bulan_id', 'bulan'



    ];
}
