<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoRekKoran extends Model
{
    use HasFactory;

    public $table = "saldo_rekkoran";

    protected $fillable = [
        'id', 'nama_bulan', 'nilai_saldorekkoran', 'tgl_saldo'
    ];
}
