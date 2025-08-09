<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPDPenerimaan extends Model
{
    use HasFactory;

    public $table = "opdpenerimaan";

    protected $fillable = [
        'id', '	id_rop', '	id_opd', '	id_akun', '	id_kelompok', '	kd_jenis', '	kd_objek', '	kd_rincianobjek', '	kd_subrincianobjek', '	no_rekening', '	nilai_pagu', '	bulan_id', '	bulan'



    ];
}
