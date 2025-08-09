<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkuPenerimaan extends Model
{
    use HasFactory;

    public $table = "bku_penerimaan";

    protected $fillable = [
        'id', 'id_kas', 'tanggal_sts', 'no_sts', 'tgl_sts', 'kd_subrincianobjek', 'no_rekening', 'uraian_kas', 'id_opd', 'id_bank', 'nilai_sts', 'bulan'
    ];
}
