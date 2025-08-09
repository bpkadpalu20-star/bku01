<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Bulan;
use Illuminate\Http\Request;
use App\Models\BkuPenerimaan;
use App\Models\BkuPengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Bku;

class TamilBKUController extends Controller implements HasMiddleware
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
    public function tampil(Request $request)
    {
        if ($request->ajax()) {
            $data = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.*', 'dana.kode_dana', 'opd.singkatan', 'bank.kode_bank')
                // ->where('bku.bulan','like',"%".$cari_bulan."%")
                // ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                // ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->get();
                return DataTables::of($data)->make(true);
        }
        $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
            ->join('bank', 'bank.id', '=' ,'bku.id_bank')
            ->select('bku.nilai_sts')
            // ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            // ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
            // ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
            ->get();
        $countsp2d = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
            ->join('opd', 'opd.id', '=' ,'bku.id_opd')
            ->join('bank', 'bank.id', '=' ,'bku.id_bank')
            ->select('bku.nilai_sp2d')
            // ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            // ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
            // ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
            ->get();
        return view('laporan.bku.tampil',[
            'countsts' => $countsts,
            'countsp2d' => $countsp2d,
            // 'data' => $data,
        ]);
    }

}
