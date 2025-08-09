<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanPenerimaan extends Model
{
    use HasFactory;

    public $table = "bulanpenerimaan";

    protected $fillable = [
        'id', '	id_opd', '	nilai_pagubulan', '	nilai_realisasibulan', '	bulan_id', '	bulan'



    ];
}
