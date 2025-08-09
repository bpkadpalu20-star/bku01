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
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class lapBkuPengeluaranController extends Controller implements HasMiddleware
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
         return view('laporan.bkupengeluaran.list',[
             'opd' => $opd,
             'bank' => $bank,
             'dana' => $dana,
         ]);
     }
     public function tampilpdf(Request $request)
     {
         $BkuPengeluaran = BkuPengeluaran::all();
         $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }
            return view('laporan.bkupengeluaran.pdfpengeluaran',[

            'count' => $count,
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
            'BkuPengeluaran' => $BkuPengeluaran,
            'bulan' => $bulan,
        ]);

     }
    public function tampil(Request $request)
    {
        if ($request->tampilawal) {
            return view('laporan.bkupengeluaran.homepengeluaran',[]);
        } else {
            $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }


            return view('laporan.bkupengeluaran.tampilpengeluaran',[
                'count' => $count,
                'opd' => $opd,
                'bank' => $bank,
                'dana' => $dana,
                'BkuPengeluaran' => $BkuPengeluaran,
                'bulan' => $bulan,
            ]);
        }




    }
    public function tampilcetak(Request $request)
    {

            $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }


            return view('laporan.bkupengeluaran.cetakpengeluaran',[
                'count' => $count,
                'opd' => $opd,
                'bank' => $bank,
                'dana' => $dana,
                'BkuPengeluaran' => $BkuPengeluaran,
                'bulan' => $bulan,
            ]);
    }

    public function tampilexcel(Request $request)
    {

            $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }


            // $Excel = Excel::loadview('laporan.bkupengeluaran.excelpengeluaran',[
            //     'count' => $count,
            //     'opd' => $opd,
            //     'bank' => $bank,
            //     'dana' => $dana,
            //     'BkuPengeluaran' => $BkuPengeluaran,
            //     'bulan' => $bulan,
            // ]);
            // return Excel::download(new $Excel, 'Laporan BKU.xlsx');
            // // return $Excel->download('Laporan BKU.xlsx');

            Excel::create('New file', function($excel) use($count,$opd,$bank,$dana,$BkuPengeluaran,$bulan) {
                $excel->sheet('Laporan BKU', function($sheet) use($count,$opd,$bank,$dana,$BkuPengeluaran,$bulan) {
                    $sheet->loadView('laporan.bkupengeluaran.excelpengeluaran', [
                        'count' => $count,
                        'opd' => $opd,
                        'bank' => $bank,
                        'dana' => $dana,
                        'BkuPengeluaran' => $BkuPengeluaran,
                        // 'bulan' => $bulan->toArray(),
                    ]);
                });
            })->download('Laporan BKU.xlsx');
    }
    public function generatePDF(Request $request)
    {
        $BkuPengeluaran = BkuPengeluaran::all();
         $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            } else {
                $bulan1 = Bulan::findOrFail($request->cari_bulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $BkuPengeluaran = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();

                $count = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                    ->select('bku_pengeluaran.nilai_sp2d')
                    ->where('bku_pengeluaran.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                    ->get();
            }
            $image = url('assets/images/logo palu.png');
            $image1 = asset('images/logopalu.png');
            // PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('laporan.bkupengeluaran.pdfpengeluaran',[
            'count' => $count,
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
            'BkuPengeluaran' => $BkuPengeluaran,
            'bulan' => $bulan,
            'image' => $image,
            'image1' => $image1,
        ])->setPaper('legal', 'landscape')
        ->setOption(['dpi' => 170, 'defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan BKU.pdf');
    }

}
