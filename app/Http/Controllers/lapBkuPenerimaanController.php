<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\User;
use App\Models\Bulan;
use App\Models\BKUAkun;
use App\Models\Rekanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BkuPenerimaan;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class lapBkuPenerimaanController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view lapBkuPenerimaans', only: ['index']),
            new Middleware('permission:edit lapBkuPenerimaans', only: ['edit']),
            new Middleware('permission:create lapBkuPenerimaans', only: ['create']),
            new Middleware('permission:delete lapBkuPenerimaans', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         $opd = Opd::all();
         $bank = Bank::all();
         $BkuAkun = BKUAkun::all();
        //  $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
        //         ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
        //         ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
        //         ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
        //         ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
        //         ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
        //         ->get();


         return view('laporan.bkupenerimaan.list',[
             'opd' => $opd,
             'bank' => $bank,
             'BkuAkun' => $BkuAkun,
            //  'BkuPenerimaan' => $BkuPenerimaan,
         ]);
     }
    public function tampilawal(Request $request)
    {
        if ($request->tampilawal) {
            return view('laporan.bkupenerimaan.homepenerimaan',[]);
        }
    }
    public function tampil(Request $request)
    {
        if ($request->tampil) {
            return view('laporan.bkupengeluaran.homepengeluaran',[]);
        } else {
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.nilai_sts')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.nilai_sts')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }

        }
            return view('laporan.bkupenerimaan.tampilpenerimaan',[
                'count' => $count,
                'BkuPenerimaan' => $BkuPenerimaan,
                'bulan' => $bulan,
            ]);

    }
    public function tampilcetak(Request $request)
    {
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.nilai_sts')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.nilai_sts')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }


            return view('laporan.bkupenerimaan.cetakpenerimaan',[
                'count' => $count,
                'BkuPenerimaan' => $BkuPenerimaan,
                'bulan' => $bulan,
            ]);
    }

    public function generatePDF(Request $request)
    {
        $BkuPenerimaan = BkuPenerimaan::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPenerimaan = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPenerimaan::join('opd', 'opd.id', '=' ,'bku_penerimaan.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_penerimaan.id_bank')
                    ->select('bku_penerimaan.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_penerimaan.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku_penerimaan.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_penerimaan.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }
            $image = url('assets/images/logo palu.png');
            $image1 = asset('images/logopalu.png');
            // PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('laporan.bkupenerimaan.pdfpenerimaan',[
            'count' => $count,
            'BkuPenerimaan' => $BkuPenerimaan,
            'bulan' => $bulan,
            'image' => $image,
            'image1' => $image1,
        ])->setPaper('legal', 'landscape')
        ->setOption(['dpi' => 170, 'defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan BKU.pdf');
    }

}
