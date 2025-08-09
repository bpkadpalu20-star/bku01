<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBulan1 extends Model
{
    use HasFactory;

    public $table = "textbulan1";

    protected $fillable = [
        'id', 'nama_bulan'
    ];
}
