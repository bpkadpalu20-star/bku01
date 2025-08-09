<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    use HasFactory;

    public $table = "rekanan";

    protected $fillable = [
        'id', 'uraian_rekanan', 'rekening_rekanan', 'alamat_rekanan', 'tlpon_rekanan'
    ];
}
