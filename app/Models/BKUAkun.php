<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKUAkun extends Model
{
    use HasFactory;

    public $table = "akun";

    protected $fillable = [
        'id_akun', 'uraian_akun'
    ];
}
