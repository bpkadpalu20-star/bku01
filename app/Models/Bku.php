<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bku extends Model
{
    use HasFactory;

    public $table = "bku";
    protected $fillable = [
       'id','id_bku','tanggal_bku','no_bku','tgl_penguji','no_penguji','id_subrincianobjek','no_rekening','uraian_bku','id_dana','id_opd','nama_rekanan','id_bank','nilai_sts','nilai_sp2d','bulan','aktif'

    ];
}
