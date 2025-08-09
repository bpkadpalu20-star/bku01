<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRekapA extends Model
{
    use HasFactory;

    public $table = "hasilrekap_a";

    protected $fillable = [
        'id', 'id_rekap', 'uraian_rekaprincian', 'nilai_a', 'bulan', 'aktif',
    ];
}
