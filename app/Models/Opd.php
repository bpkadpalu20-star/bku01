<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    public $table = "opd";

    protected $fillable = [
        'id', 'uraian_skpd', 'kode', 'singkatan'
    ];
}
