<?php

namespace App\Http\Controllers;

use App\Models\Bku;
use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Bulan;
use App\Models\RekapA;
use App\Models\RekapB;
use App\Models\HasilRekapA;
use App\Models\HasilRekapB;
use Illuminate\Http\Request;
use App\Models\SaldoRekKoran;
use App\Models\BkuPengeluaran;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PrinRincianBKUController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view LaporanBKUs', only: ['index']),
            new Middleware('permission:edit LaporanBKUs', only: ['edit']),
            new Middleware('permission:create LaporanBKUs', only: ['create']),
            new Middleware('permission:delete LaporanBKUs', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

         return view('laporan.rincianbku.cetakbku',[

        ]);

    }
    public function pdf(Request $request)
    {
        $caribulan = $request->cari_bulan;


         return view('laporan.rincianbku.cetakbku',[
            'caribulan' => $caribulan,
             ]);
    }


}
