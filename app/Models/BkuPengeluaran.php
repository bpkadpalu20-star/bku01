<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkuPengeluaran extends Model
{
    use HasFactory;

    public $table = "bku_pengeluaran";

    protected $fillable = [
        'id', 'id_sp2d', 'no_sp2d', 'tanggal_sp2d', 'uraian_sp2d', 'id_dana', 'id_opd', 'id_rekanan', 'id_bank', 'nilai_sp2d', 'bulan'
    ];
}
