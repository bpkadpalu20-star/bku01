<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRekapB extends Model
{
    use HasFactory;

    public $table = "hasilrekap_b";

    protected $fillable = [
        'id', 'id_rekap', 'id_rekaprincian', 'kode_rekaprincianc', 'uraian_rekaprincianc', 'nilai_sp2d', 'bulan'
    ];
}
