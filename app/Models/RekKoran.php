<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekKoran extends Model
{
    use HasFactory;

    public $table = "rek_koran";

    protected $fillable = [
        'id', 'uraian_rekkoran', 'nama_bulan', 'nilai_rekkoran'
    ];
}
