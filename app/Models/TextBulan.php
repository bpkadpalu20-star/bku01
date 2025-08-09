<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBulan extends Model
{
    use HasFactory;

    public $table = "textbulan";

    protected $fillable = [
        'id', 'nama_bulan'
    ];
}
