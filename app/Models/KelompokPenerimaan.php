<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokPenerimaan extends Model
{
    use HasFactory;

    public $table = "kelompokpenerimaan";

    protected $fillable = [
        'id', ' id_opd', '	id_akun', 'id_kelompok', 'kode_kelompok', 'nilai_pagukelompok', 'nilai_realisasikelompok', 'bulan_id', 'bulan',



    ];
}
