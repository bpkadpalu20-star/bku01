<?php

namespace App\Http\Controllers;

use App\Models\Bku;
use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Bulan;
use App\Models\BKUJenis;
use App\Models\BKUObjek;
use App\Models\TextBulan;
use App\Models\BKUKelompok;
use Illuminate\Http\Request;
use App\Models\OPDPenerimaan;
use App\Models\SaldoRekKoran;
use App\Models\BKURincianobjek;
use App\Models\BulanPenerimaan;
use App\Models\JenisPenerimaan;
use App\Models\ObjekPenerimaan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BKUSubrincianobjek;
use App\Models\KelompokPenerimaan;
use App\Models\rincianobjekPenerimaan;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class LaporanRekapPenerimaanController extends Controller implements HasMiddleware
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

        return view('laporan.rekappenerimaan.list',[
        'opd' => $opd,
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

                    return view('laporan.rekappenerimaan.tampil',[]);

    }
    public function tampil(Request $request)
    {
        if ($request->cari_bulan) {
            $K = 'K';
            $D = 'D';
            $January = 'January';
            $February = 'February';
            $March = 'March';
            $April = 'April';
            $May = 'May';
            $June = 'June';
            $July = 'July';
            $August = 'August';
            $September = 'September';
            $October = 'October';
            $November = 'November';
            $December = 'December';
            $bulan = $request->cari_bulan;
            $Bulan1 = TextBulan::findOrFail($request->cari_bulan);
            $Bulan13 = $Bulan1->kode_bulan;
            $BKUSubrincianobjek = BKUSubrincianobjek::all();
            $BKURincianobjek = BKURincianobjek::all();
            $BKUObjek = BKUObjek::all();
            $BKUKelompok = BKUKelompok::all();
            $BKUJenis = BKUJenis::all();

            // $Opd = Opd::all();
            $Opd = Opd::where('opd.aktif_penerimaan','Y')
            ->get();
            $BulanPenerimaan = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
            ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
            ->get();
            $penerimaan = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
            ->select('bku.id_opd')
            ->where('bku.aktif_bku','PENERIMAAN')
            ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            ->where('bku.aktif','like', "N")
            ->get();
            $KelompokPenerimaan = KelompokPenerimaan::all();

            // $KelompokPenerimaan = OPDPenerimaan::all();

            $JenisPenerimaan = JenisPenerimaan::join('jenis', 'jenis.id', '=' ,'jenispenerimaan.kd_jenis')
            ->select('jenispenerimaan.*', 'jenis.uraian_jenis')
            ->get();
            $ObjekPenerimaan = ObjekPenerimaan::join('objek', 'objek.id', '=' ,'objekpenerimaan.kd_objek')
            ->select('objekpenerimaan.*', 'objek.uraian_objek')
            ->get();
            $RincianObjekPenerimaan = RincianObjekPenerimaan::join('rincian_objek', 'rincian_objek.id', '=' ,'rincianobjekpenerimaan.kd_rincianobjek')
            ->select('rincianobjekpenerimaan.*', 'rincian_objek.uraian_rincianobjek')
            ->get();
            $OPDPenerimaan = OPDPenerimaan::join('sub_rincianobjek', 'sub_rincianobjek.id', '=' ,'opdpenerimaan.kd_subrincianobjek')
                ->select('opdpenerimaan.*', 'sub_rincianobjek.uraian_subrincianobjek')
                ->get();
            $BulanPenerimaantotal = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
                ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
                ->get();

            $Kelompoktotal1 = OPDPenerimaan::where('opdpenerimaan.bulan','like', "%".$request->cari_bulan."%")
                ->where('opdpenerimaan.id_akun','4')
                ->where('opdpenerimaan.id_kelompok','1')
                ->get();
            $Kelompoktotal2 = OPDPenerimaan::where('opdpenerimaan.bulan','like', "%".$request->cari_bulan."%")
                ->where('opdpenerimaan.id_akun','4')
                ->where('opdpenerimaan.id_kelompok','2')
                ->get();
            $Kelompoktotal3 = OPDPenerimaan::where('opdpenerimaan.bulan','like', "%".$request->cari_bulan."%")
                ->where('opdpenerimaan.id_akun','4')
                ->where('opdpenerimaan.id_kelompok','3')
                ->get();

            $idbulan = $request->cari_bulan;

            $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
            $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);
        return view('laporan.rekappenerimaan.tampil',[
            'bulan' => $bulan,
            'BulanPenerimaan' => $BulanPenerimaan,
            'penerimaan' => $penerimaan,
            'Opd' => $Opd,
            'BKURincianobjek' => $BKURincianobjek,
            'BKUSubrincianobjek' => $BKUSubrincianobjek,
            'BKUJenis' => $BKUJenis,
            'OPDPenerimaan' => $OPDPenerimaan,
            'ObjekPenerimaan' => $ObjekPenerimaan,
            'BKUObjek' => $BKUObjek,
            'BKUKelompok' => $BKUKelompok,
            'KelompokPenerimaan' => $KelompokPenerimaan,
            'JenisPenerimaan' => $JenisPenerimaan,
            'RincianObjekPenerimaan' => $RincianObjekPenerimaan,
            'BulanPenerimaantotal' => $BulanPenerimaantotal,
            'Kelompoktotal1' => $Kelompoktotal1,
            'Kelompoktotal2' => $Kelompoktotal2,
            'Kelompoktotal3' => $Kelompoktotal3,
            // 'bkudebetDecember' => $bkudebetDecember,
            // 'SaldoRekKoran' => $SaldoRekKoran,
            // 'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,

        ]);

        }
    }
    public function tampilawal(Request $request)
    {
        if ($request->tampilawal == '0') {
            return view('laporan.rekappenerimaan.homebku',[]);
        }
    }
    public function generatePDF(Request $request)
    {
        $January = 'January';
            $February = 'February';
            $March = 'March';
            $April = 'April';
            $May = 'May';
            $June = 'June';
            $July = 'July';
            $August = 'August';
            $September = 'September';
            $October = 'October';
            $November = 'November';
            $December = 'December';
        $bulan = $request->cari_bulan;
            $Bulan1 = TextBulan::findOrFail($request->cari_bulan);
            $Bulan13 = $Bulan1->kode_bulan;
            $BKUSubrincianobjek = BKUSubrincianobjek::all();
            $BKURincianobjek = BKURincianobjek::all();
            $BKUObjek = BKUObjek::all();
            $BKUKelompok = BKUKelompok::all();
            $BKUJenis = BKUJenis::all();

        // $Opd = Opd::all();
        $Opd = Opd::where('Opd.aktif_penerimaan','Y')
        ->get();
        $BulanPenerimaan = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
        ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
        ->get();
        $penerimaan = Bku::select('bku.id_opd')
        ->where('bku.aktif_bku','PENERIMAAN')
        ->where('bku.bulan','like', "%".$request->cari_bulan."%")
        ->where('bku.aktif','like', "N")
        ->get();
        $KelompokPenerimaan = KelompokPenerimaan::all();
        $JenisPenerimaan = JenisPenerimaan::join('jenis', 'jenis.id', '=' ,'jenispenerimaan.kd_jenis')
        ->select('jenispenerimaan.*', 'jenis.uraian_jenis')
        ->get();
        $ObjekPenerimaan = ObjekPenerimaan::join('objek', 'objek.id', '=' ,'objekpenerimaan.kd_objek')
        ->select('objekpenerimaan.*', 'objek.uraian_objek')
        ->get();
        $RincianObjekPenerimaan = RincianObjekPenerimaan::join('rincian_objek', 'rincian_objek.id', '=' ,'rincianobjekpenerimaan.kd_rincianobjek')
        ->select('rincianobjekpenerimaan.*', 'rincian_objek.uraian_rincianobjek')
        ->get();
        $OPDPenerimaan = OPDPenerimaan::join('sub_rincianobjek', 'sub_rincianobjek.id', '=' ,'opdpenerimaan.kd_subrincianobjek')
            ->select('opdpenerimaan.*', 'sub_rincianobjek.uraian_subrincianobjek')
            ->get();
        $BulanPenerimaantotal = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
            ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
            ->get();
        $idbulan = $request->cari_bulan;

        $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
        $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);

            $image = url('assets/images/logo palu.png');
            $image1 = asset('images/logopalu.png');
            // PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('laporan.rekappenerimaan.pdfbku',[
           'bulan' => $bulan,
        'BulanPenerimaan' => $BulanPenerimaan,
        'penerimaan' => $penerimaan,
        'Opd' => $Opd,
        'BKURincianobjek' => $BKURincianobjek,
        'BKUSubrincianobjek' => $BKUSubrincianobjek,
        'BKUJenis' => $BKUJenis,
        'OPDPenerimaan' => $OPDPenerimaan,
        'ObjekPenerimaan' => $ObjekPenerimaan,
        'BKUObjek' => $BKUObjek,
        'BKUKelompok' => $BKUKelompok,
        'KelompokPenerimaan' => $KelompokPenerimaan,
        'JenisPenerimaan' => $JenisPenerimaan,
        'RincianObjekPenerimaan' => $RincianObjekPenerimaan,
        'BulanPenerimaantotal' => $BulanPenerimaantotal,
        // 'bkudebetDecember' => $bkudebetDecember,
        // 'SaldoRekKoran' => $SaldoRekKoran,
        // 'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,
            'image' => $image,
            'image1' => $image1,
        ])->setPaper('legal', 'landscape')
        ->setOption(['dpi' => 170, 'defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan BKU.pdf');
    }

    public function tampilcetak(Request $request)
    {
        $January = 'January';
            $February = 'February';
            $March = 'March';
            $April = 'April';
            $May = 'May';
            $June = 'June';
            $July = 'July';
            $August = 'August';
            $September = 'September';
            $October = 'October';
            $November = 'November';
            $December = 'December';
        $bulan = $request->cari_bulan;
            $Bulan1 = TextBulan::findOrFail($request->cari_bulan);
            $Bulan13 = $Bulan1->kode_bulan;
            $BKUSubrincianobjek = BKUSubrincianobjek::all();
            $BKURincianobjek = BKURincianobjek::all();
            $BKUObjek = BKUObjek::all();
            $BKUKelompok = BKUKelompok::all();
            $BKUJenis = BKUJenis::all();

        // $Opd = Opd::all();
        $Opd = Opd::where('Opd.aktif_penerimaan','Y')
        ->get();
        $BulanPenerimaan = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
        ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
        ->get();
        $penerimaan = Bku::select('bku.id_opd')
        ->where('bku.aktif_bku','PENERIMAAN')
        ->where('bku.bulan','like', "%".$request->cari_bulan."%")
        ->where('bku.aktif','like', "N")
        ->get();
        $KelompokPenerimaan = KelompokPenerimaan::all();
        $JenisPenerimaan = JenisPenerimaan::join('jenis', 'jenis.id', '=' ,'jenispenerimaan.kd_jenis')
        ->select('jenispenerimaan.*', 'jenis.uraian_jenis')
        ->get();
        $ObjekPenerimaan = ObjekPenerimaan::join('objek', 'objek.id', '=' ,'objekpenerimaan.kd_objek')
        ->select('objekpenerimaan.*', 'objek.uraian_objek')
        ->get();
        $RincianObjekPenerimaan = RincianObjekPenerimaan::join('rincian_objek', 'rincian_objek.id', '=' ,'rincianobjekpenerimaan.kd_rincianobjek')
        ->select('rincianobjekpenerimaan.*', 'rincian_objek.uraian_rincianobjek')
        ->get();
        $OPDPenerimaan = OPDPenerimaan::join('sub_rincianobjek', 'sub_rincianobjek.id', '=' ,'opdpenerimaan.kd_subrincianobjek')
            ->select('opdpenerimaan.*', 'sub_rincianobjek.uraian_subrincianobjek')
            ->get();
        $BulanPenerimaantotal = BulanPenerimaan::join('opd', 'opd.id', '=' ,'bulanpenerimaan.id_opd')
            ->where('bulanpenerimaan.bulan','like', "%".$request->cari_bulan."%")
            ->get();
        $idbulan = $request->cari_bulan;

        $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
        $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);

    return view('laporan.rekappenerimaan.cetakbku',[
        'bulan' => $bulan,
        'BulanPenerimaan' => $BulanPenerimaan,
        'penerimaan' => $penerimaan,
        'Opd' => $Opd,
        'BKURincianobjek' => $BKURincianobjek,
        'BKUSubrincianobjek' => $BKUSubrincianobjek,
        'BKUJenis' => $BKUJenis,
        'OPDPenerimaan' => $OPDPenerimaan,
        'ObjekPenerimaan' => $ObjekPenerimaan,
        'BKUObjek' => $BKUObjek,
        'BKUKelompok' => $BKUKelompok,
        'KelompokPenerimaan' => $KelompokPenerimaan,
        'JenisPenerimaan' => $JenisPenerimaan,
        'RincianObjekPenerimaan' => $RincianObjekPenerimaan,
        'BulanPenerimaantotal' => $BulanPenerimaantotal,
        // 'bkudebetDecember' => $bkudebetDecember,
        // 'SaldoRekKoran' => $SaldoRekKoran,
        // 'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,

    ]);
    }

}
