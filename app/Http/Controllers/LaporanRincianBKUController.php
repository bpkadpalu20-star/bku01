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
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\laporan\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class LaporanRincianBKUController extends Controller implements HasMiddleware
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

        return view('laporan.rincianbku.list',[

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

                    return view('laporan.rincianbku.tampil',[]);

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
            $rekapa = RekapA::all();
            $rekapb = RekapB::all();
            // $NilaiHasilRekapB = Bulan::all();
            $HasilRekapA = HasilRekapA::select('hasilrekap_a.*')
                ->where('hasilrekap_a.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $HasilRekapB = HasilRekapB::select('hasilrekap_b.*')
                ->where('hasilrekap_b.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $NilaiHasilRekapB = Bulan::select('tblbulan.*')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countkredit = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','K')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countdebet = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','D')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            // $bkukredit = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENGELUARAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkukreditJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();

            // $bkudebet = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENERIMAAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkudebetJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $idbulan = $request->cari_bulan;
            $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
            $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);
        return view('laporan.rincianbku.tampil',[
            'bulan' => $bulan,
            'rekapa' => $rekapa,
            'rekapb' => $rekapb,
            'HasilRekapA' => $HasilRekapA,
            'HasilRekapB' => $HasilRekapB,
            'NilaiHasilRekapB' => $NilaiHasilRekapB,
            'countkredit' => $countkredit,
            'countdebet' => $countdebet,
            'bkukreditJanuary' => $bkukreditJanuary,
            'bkudebetJanuary' => $bkudebetJanuary,
            'bkukreditFebruary' => $bkukreditFebruary,
            'bkudebetFebruary' => $bkudebetFebruary,
            'bkukreditMarch' => $bkukreditMarch,
            'bkudebetMarch' => $bkudebetMarch,
            'bkukreditApril' => $bkukreditApril,
            'bkudebetApril' => $bkudebetApril,
            'bkukreditMay' => $bkukreditMay,
            'bkudebetMay' => $bkudebetMay,
            'bkukreditJune' => $bkukreditJune,
            'bkudebetJune' => $bkudebetJune,
            'bkukreditJuly' => $bkukreditJuly,
            'bkudebetJuly' => $bkudebetJuly,
            'bkukreditAugust' => $bkukreditAugust,
            'bkudebetAugust' => $bkudebetAugust,
            'bkukreditSeptember' => $bkukreditSeptember,
            'bkudebetSeptember' => $bkudebetSeptember,
            'bkukreditOctober' => $bkukreditOctober,
            'bkudebetOctober' => $bkudebetOctober,
            'bkukreditNovember' => $bkukreditNovember,
            'bkudebetNovember' => $bkudebetNovember,
            'bkukreditDecember' => $bkukreditDecember,
            'bkudebetDecember' => $bkudebetDecember,
            'SaldoRekKoran' => $SaldoRekKoran,
            'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,

        ]);
        } else {
            return view('laporan.rincianbku.homebku',[]);
        }
    }
    public function tampilawal(Request $request)
    {
        if ($request->tampilawal == '0') {
            return view('laporan.rincianbku.homebku',[]);
        }
    }
    public function generatePDF(Request $request)
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
            $rekapa = RekapA::all();
            $rekapb = RekapB::all();
            // $NilaiHasilRekapB = Bulan::all();
            $HasilRekapA = HasilRekapA::select('hasilrekap_a.*')
                ->where('hasilrekap_a.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $HasilRekapB = HasilRekapB::select('hasilrekap_b.*')
                ->where('hasilrekap_b.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $NilaiHasilRekapB = Bulan::select('tblbulan.*')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countkredit = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','K')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countdebet = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','D')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            // $bkukredit = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENGELUARAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkukreditJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();

            // $bkudebet = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENERIMAAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkudebetJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $idbulan = $request->cari_bulan;
            $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
            $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);

        }
            $image = url('assets/images/logo palu.png');
            $image1 = asset('images/logopalu.png');
            // PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadview('laporan.rincianbku.pdfbku',[
            'bulan' => $bulan,
            'rekapa' => $rekapa,
            'rekapb' => $rekapb,
            'HasilRekapA' => $HasilRekapA,
            'HasilRekapB' => $HasilRekapB,
            'NilaiHasilRekapB' => $NilaiHasilRekapB,
            'countkredit' => $countkredit,
            'countdebet' => $countdebet,
            'bkukreditJanuary' => $bkukreditJanuary,
            'bkudebetJanuary' => $bkudebetJanuary,
            'bkukreditFebruary' => $bkukreditFebruary,
            'bkudebetFebruary' => $bkudebetFebruary,
            'bkukreditMarch' => $bkukreditMarch,
            'bkudebetMarch' => $bkudebetMarch,
            'bkukreditApril' => $bkukreditApril,
            'bkudebetApril' => $bkudebetApril,
            'bkukreditMay' => $bkukreditMay,
            'bkudebetMay' => $bkudebetMay,
            'bkukreditJune' => $bkukreditJune,
            'bkudebetJune' => $bkudebetJune,
            'bkukreditJuly' => $bkukreditJuly,
            'bkudebetJuly' => $bkudebetJuly,
            'bkukreditAugust' => $bkukreditAugust,
            'bkudebetAugust' => $bkudebetAugust,
            'bkukreditSeptember' => $bkukreditSeptember,
            'bkudebetSeptember' => $bkudebetSeptember,
            'bkukreditOctober' => $bkukreditOctober,
            'bkudebetOctober' => $bkudebetOctober,
            'bkukreditNovember' => $bkukreditNovember,
            'bkudebetNovember' => $bkudebetNovember,
            'bkukreditDecember' => $bkukreditDecember,
            'bkudebetDecember' => $bkudebetDecember,
            'SaldoRekKoran' => $SaldoRekKoran,
            'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,
            'image' => $image,
            'image1' => $image1,
        ])->setPaper('legal', 'landscape')
        ->setOption(['dpi' => 170, 'defaultFont' => 'sans-serif']);
        return $pdf->download('Laporan Rincian BKU.pdf');
    }

    public function tampilcetak(Request $request)
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
            $rekapa = RekapA::all();
            $rekapb = RekapB::all();
            // $NilaiHasilRekapB = Bulan::all();
            $HasilRekapA = HasilRekapA::select('hasilrekap_a.*')
                ->where('hasilrekap_a.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $HasilRekapB = HasilRekapB::select('hasilrekap_b.*')
                ->where('hasilrekap_b.bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $NilaiHasilRekapB = Bulan::select('tblbulan.*')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countkredit = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','K')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            $countdebet = Bulan::select('tblbulan.*')
                ->where('tblbulan.status','D')
                ->where('tblbulan.nama_bulan','like', "%".$request->cari_bulan."%")
                ->get();
            // $bkukredit = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENGELUARAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkukreditJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkukreditDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENGELUARAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();

            // $bkudebet = Bku::select('bku.*')
            //     ->where('bku.aktif_bku','PENERIMAAN')
            //     ->where('bku.bulan','like', "%".$request->cari_bulan."%")
            //     ->where('bku.aktif','like', "N")
            //     ->get();
            $bkudebetJanuary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$January."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetFebruary = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$February."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMarch = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$March."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetApril = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$April."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetMay = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$May."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJune = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$June."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetJuly = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$July."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetAugust = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$August."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetSeptember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$September."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetOctober = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$October."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetNovember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$November."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $bkudebetDecember = Bku::select('bku.*')
                ->where('bku.aktif_bku','PENERIMAAN')
                ->where('bku.bulan','like', "%".$December."%")
                ->where('bku.aktif','like', "N")
                ->get();
            $idbulan = $request->cari_bulan;
            $SaldoRekKoran = SaldoRekKoran::findOrFail($idbulan);
            $SaldoRekKoranJanuary = SaldoRekKoran::findOrFail($January);
        return view('laporan.rincianbku.cetakbku',[
            'bulan' => $bulan,
            'rekapa' => $rekapa,
            'rekapb' => $rekapb,
            'HasilRekapA' => $HasilRekapA,
            'HasilRekapB' => $HasilRekapB,
            'NilaiHasilRekapB' => $NilaiHasilRekapB,
            'countkredit' => $countkredit,
            'countdebet' => $countdebet,
            'bkukreditJanuary' => $bkukreditJanuary,
            'bkudebetJanuary' => $bkudebetJanuary,
            'bkukreditFebruary' => $bkukreditFebruary,
            'bkudebetFebruary' => $bkudebetFebruary,
            'bkukreditMarch' => $bkukreditMarch,
            'bkudebetMarch' => $bkudebetMarch,
            'bkukreditApril' => $bkukreditApril,
            'bkudebetApril' => $bkudebetApril,
            'bkukreditMay' => $bkukreditMay,
            'bkudebetMay' => $bkudebetMay,
            'bkukreditJune' => $bkukreditJune,
            'bkudebetJune' => $bkudebetJune,
            'bkukreditJuly' => $bkukreditJuly,
            'bkudebetJuly' => $bkudebetJuly,
            'bkukreditAugust' => $bkukreditAugust,
            'bkudebetAugust' => $bkudebetAugust,
            'bkukreditSeptember' => $bkukreditSeptember,
            'bkudebetSeptember' => $bkudebetSeptember,
            'bkukreditOctober' => $bkukreditOctober,
            'bkudebetOctober' => $bkudebetOctober,
            'bkukreditNovember' => $bkukreditNovember,
            'bkudebetNovember' => $bkudebetNovember,
            'bkukreditDecember' => $bkukreditDecember,
            'bkudebetDecember' => $bkudebetDecember,
            'SaldoRekKoran' => $SaldoRekKoran,
            'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,

        ]);
        }
    }

}
