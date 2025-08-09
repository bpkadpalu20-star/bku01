<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\User;
use App\Models\Bulan;
use App\Models\Rekanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BkuPengeluaran;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class cetakBkuPengeluaranController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view lapBkuPengeluarans', only: ['index']),
            new Middleware('permission:edit lapBkuPengeluarans', only: ['edit']),
            new Middleware('permission:create lapBkuPengeluarans', only: ['create']),
            new Middleware('permission:delete lapBkuPengeluarans', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
        $opd = Opd::all();
        $bank = Bank::all();
        $dana = Dana::all();
        if ($request->cari_bulan == 'year') {
            $bulan1 = Bulan::findOrFail($request->cari_bulan);
            $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
        } else {
            $bulan1 = Bulan::findOrFail($request->cari_bulan);
            $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;
        }
        $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
            ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
            ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
            ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.singkatan', 'bank.kode_bank')
            ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
            ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
            ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
            ->where('bku_pengeluaran.no_sp2d','like',"%".$request->cari_no_sp2d."%")
            ->where('bku_pengeluaran.no_penguji','like',"%".$request->cari_no_penguji."%")
            ->where('bku_pengeluaran.nilai_sp2d','like',"%".$request->cari_nilai_sp2d."%")
            ->get();

        $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
            ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
            ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
            ->select('bku_pengeluaran.nilai_sp2d')
            ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
            ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
            ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
            ->where('bku_pengeluaran.no_sp2d','like',"%".$request->cari_no_sp2d."%")
            ->where('bku_pengeluaran.no_penguji','like',"%".$request->cari_no_penguji."%")
            ->where('bku_pengeluaran.nilai_sp2d','like',"%".$request->cari_nilai_sp2d."%")
            ->get();

        return view('laporan.cetakpengeluaran.list',[
            'count' => $count,
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
            'BkuPengeluaran' => $BkuPengeluaran,
            'bulan' => $bulan,
        ]);
     }


}
