<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    public $table = "dana";

    protected $fillable = [
        'id', 'uraian_dana', 'kode_dana'
    ];
}
