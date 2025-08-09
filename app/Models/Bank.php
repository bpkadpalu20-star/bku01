<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public $table = "bank";

    protected $fillable = [
        'id', 'uraian_bank', 'kode_bank', 'uraian_bank'
    ];
}
