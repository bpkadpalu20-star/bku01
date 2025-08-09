<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapB extends Model
{
    use HasFactory;

    public $table = "rekap_b";

    protected $fillable = [
        'id', 'id_rekap', 'uraian_rekaprincian', 'nilai_rekapb', 'aktif', 'bulan'
    ];
}
