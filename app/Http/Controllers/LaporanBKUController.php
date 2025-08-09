<?php

namespace App\Http\Controllers;

use App\Models\Bku;
use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Bulan;
use App\Models\TextBulan;
use App\Models\TextBulan1;
use Illuminate\Http\Request;
use App\Models\BkuPenerimaan;
use App\Models\BkuPengeluaran;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class LaporanBKUController extends Controller implements HasMiddleware
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
        $opd = Opd::all();
        $bank = Bank::all();
        $dana = Dana::all();
        if ($request->cari_bulan == 'year') {
            $cari_bulan = '';
            // $cari_id_dana = '';
            // $cari_id_opd = '';
            // $cari_id_bank = '';
            if ($request->ajax()) {
                $data = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like',"%".$cari_bulan."%")
                    ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();

                    return DataTables::of($data)->make(true);

            }
        } else {
            if ($request->ajax()) {
                $data = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    // ->join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->select('bku.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like',"%".$request->cari_bulan."%")
                    ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
                    return DataTables::of($data)->make(true);
            }
        }
        return view('laporan.bku.list',[
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
                //    'countsts' => $countsts,
                // 'countsp2d' => $countsp2d,
                // 'bulan' => $bulan,
        ]);

    }
    public function tampil1(Request $request)
    {

                // if ($request->ajax()) {
                //     $data = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                //         ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                //         ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                //         ->select('bku.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                //         // ->where('bku.bulan','like',"%".$cari_bulan."%")
                //         // ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                //         // ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                //         ->get();
                //         return DataTables::of($data)->make(true);

                // }

                    return view('laporan.bku.tampil',[]);

    }
    public function tampil(Request $request)
    {
        if ($request->tampil == '0') {
            return view('laporan.bku.homebku',[]);

        } elseif ($request->cari_bulan == 'year') {
            $caribulan = '13';
            $bulan1 = TextBulan1::findOrFail($caribulan);
            $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
            $cari_bulan = '';
            $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.nilai_sts')
                ->where('bku.aktif','like', 'N')
                ->where('bku.bulan','like', "%".$cari_bulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                ->get();
            $countsp2d = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.nilai_sp2d')
                ->where('bku.aktif','like', 'N')
                ->where('bku.bulan','like', "%".$cari_bulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                ->get();
                // return view('laporan.bku.tampil',[]);
                return view('laporan.bku.tampil',[

                           'countsts' => $countsts,
                        'countsp2d' => $countsp2d,
                        'bulan' => $bulan,
                ]);

        } else {
            $caribulan = Carbon::make($request->cari_bulan)->format("m");

            $bulan1 = TextBulan1::findOrFail($caribulan);
            $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

            $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.nilai_sts')
                ->where('bku.aktif','like', 'N')
                ->where('bku.bulan_id','like', "%".$caribulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                ->get();
            $countsp2d = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.nilai_sp2d')
                ->where('bku.aktif','like', 'N')
                ->where('bku.bulan_id','like', "%".$caribulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                ->where('bku.id_dana','like',"%".$request->cari_id_dana."%")
                ->get();
                // return view('laporan.bku.tampil',[]);
                return view('laporan.bku.tampil',[

                        'countsts' => $countsts,
                        'countsp2d' => $countsp2d,
                        'bulan' => $bulan,
                ]);
        }
    }
    public function tampilawal(Request $request)
    {
        if ($request->tampilawal == '0') {
            return view('laporan.bku.homebku',[]);
        }
    }
    public function generatePDF(Request $request)
    {
        // $BkuPengeluaran = BkuPengeluaran::all();
         $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {
                $caribulan = '13';
                $bulan1 = TextBulan1::findOrFail($caribulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $Bku = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like',"%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();

                $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sts')
                    ->where('bku.bulan','like', "%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
                $countsp2d = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sp2d')
                    ->where('bku.bulan','like', "%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
            } else {
                $caribulan = Carbon::make($request->cari_bulan)->format("m");

                $bulan1 = TextBulan1::findOrFail($caribulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $Bku = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();

                $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sts')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
                $countsp2d = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sp2d')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
            }
            $image = url('assets/images/logo palu.png');
            $image1 = asset('images/logopalu.png');
            // PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('laporan.bku.pdfbku',[
            'countsts' => $countsts,
            'countsp2d' => $countsp2d,
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
            'Bku' => $Bku,
            'bulan' => $bulan,
            'image' => $image,
            'image1' => $image1,
        ])->setPaper('legal', 'landscape')
        ->setOption(['dpi' => 170, 'defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan BKU.pdf');
    }

    public function tampilcetak(Request $request)
    {

            $opd = Opd::all();
            $bank = Bank::all();
            $dana = Dana::all();
            if ($request->cari_bulan == 'year') {

                $caribulan = '13';
                $bulan1 = TextBulan1::findOrFail($caribulan);
                $bulan = 'Satu'. ' '. $bulan1->nama_bulan;
                $cari_bulan = '';
                $Bku = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.*', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like',"%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();

                $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sts')
                    ->where('bku.bulan','like', "%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
                $countsp2d = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sp2d')
                    ->where('bku.bulan','like', "%".$cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
            } else {
                $caribulan = Carbon::make($request->cari_bulan)->format("m");

                $bulan1 = TextBulan1::findOrFail($caribulan);
                $bulan = 'Bulan'. ' '. $bulan1->nama_bulan;

                $Bku = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();

                $countsts = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sts')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
                $countsp2d = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                    ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                    ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                    ->select('bku.nilai_sp2d')
                    ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                    ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                    ->where('bku.aktif_bku','like',"%".$request->cari_bku."%")
                    ->get();
            }


            return view('laporan.bku.cetakbku',[
                'countsts' => $countsts,
                'countsp2d' => $countsp2d,
                'Bku' => $Bku,
                'bulan' => $bulan,
            ]);
    }

}
