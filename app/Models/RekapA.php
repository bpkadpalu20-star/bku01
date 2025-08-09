<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapA extends Model
{
    use HasFactory;

    public $table = "rekap_a";

    protected $fillable = [
        'id', 'uraian_rekap', 'nilai_rekapa'
    ];
}
