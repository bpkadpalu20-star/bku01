<?php

namespace App\Http\Controllers;


use App\Models\Bku;
use App\Models\Opd;
use App\Models\RekapA;
use App\Models\RekapB;
use App\Models\BKUJenis;
use App\Models\BKUObjek;
use App\Models\TextBulan;
use App\Models\BKUKelompok;
use App\Models\HasilRekapA;
use Illuminate\Http\Request;
use App\Models\OPDPenerimaan;
use App\Models\SaldoRekKoran;
use Illuminate\Support\Carbon;
use App\Models\BKURincianobjek;
use App\Models\BulanPenerimaan;
use App\Models\JenisPenerimaan;
use App\Models\ObjekPenerimaan;
use Illuminate\Http\JsonResponse;
use App\Models\BKUSubrincianobjek;
use App\Models\KelompokPenerimaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RincianObjekPenerimaan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PaguPenerimanController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view pagupenerimans', only: ['index']),
            new Middleware('permission:edit pagupenerimans', only: ['edit']),
            new Middleware('permission:create pagupenerimans', only: ['create']),
            new Middleware('permission:delete pagupenerimans', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $rekapa = RekapA::all();
        // $rekapb = RekapB::all();
        // // $rekapA = HasilRekapA::all();
        // $tiga = RekapB::select('rekap_b.*')
        //     ->where('rekap_b.id_rekap','like', "3")
        //     ->get();
        // $empat = RekapB::select('rekap_b.*')
        //     ->where('rekap_b.id_rekap','like', "4")
        //     ->get();
        // $rekapbb = RekapB::join('rekap_b', 'rekap_b.id_rekap', '=' ,'rekap_a.id')
        //     ->from('rekap_a')
        //     ->select('rekap_a.*', 'rekap_b.*')
        //     ->orderBy('id_rekap')
        //     ->get();

        return view('pagupeneriman.list',[
            // 'rekapa' => $rekapa,
            // 'rekapb' => $rekapb,
            // 'rekapbb' => $rekapbb,
            // 'rekapc' => $rekapc,
            // 'empat' => $empat,
        ]);

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
            $BulanPenerimaan1 = BulanPenerimaan::all();
            // $Opd = Opd::all();
            // $Opd = Opd::where('Opd.aktif_penerimaan','Y')
            // ->get();
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
        return view('pagupeneriman.menu',[
            'bulan' => $bulan,
            'BulanPenerimaan' => $BulanPenerimaan,
            'penerimaan' => $penerimaan,
            // 'Opd' => $Opd,
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
            'BulanPenerimaan1' => $BulanPenerimaan1,
            // 'SaldoRekKoran' => $SaldoRekKoran,
            // 'SaldoRekKoranJanuary' => $SaldoRekKoranJanuary,

        ]);

        } else {
            return view('pagupeneriman.homerekap',[]);
        }
    }

    public function createrinciansub(Request $request)
    {
        $id =  $request->input('rincian_id');
        $rincian = OPDPenerimaan::findOrFail($id);

        $id =  $rincian->kd_subrincianobjek;
        $subrincianobjek = BKUSubrincianobjek::findOrFail($id);

        return view('pagupeneriman.rinciansub',[
            'subrincianobjek' => $subrincianobjek,
            'rincian' => $rincian,
        ]);
    }
    public function storerinciansub(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'create_nilapagu' => 'required',
        ],
        [
            'create_nilapagu' => 'Pagu Masih Kosong',
        ]);
        $idbn = $request->create_bulan_id. $request->create_id_opd;
        $idkp = $request->create_bulan_id. $request->create_id_opd. $request->create_akun. $request->create_kelompok;
        $idjp = $request->create_bulan_id. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis;
        $idop = $request->create_bulan_id. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek;
        $idrop = $request->create_bulan_id. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek. $request->create_rincianObjek;

        $nilai_pagu = str_replace('.','',$request->create_nilapagu);

        $NilaiAwal =   OPDPenerimaan::where(['id' => $request->create_id,])->first();
        $NilaiAwal2 = $NilaiAwal->nilai_paguopd;
        $HasilRincianObjekPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_paguopd')
                            ->where(['opdpenerimaan.bulan_id' => $request->create_bulan_id,])
                            ->where(['opdpenerimaan.id_opd' => $request->create_id_opd,])
                            ->where(['opdpenerimaan.id_akun' => $request->create_akun,])
                            ->where(['opdpenerimaan.id_kelompok' => $request->create_kelompok,])
                            ->where(['opdpenerimaan.kd_jenis' => $request->create_jenis,])
                            ->where(['opdpenerimaan.kd_objek' => $request->create_Objek,])
                            ->where(['opdpenerimaan.kd_rincianobjek' => $request->create_rincianObjek,])
                            ->get();

        $sumrekapopd = $HasilRincianObjekPenerimaan->sum('nilai_paguopd');
        $KurangRincianObjekPenerimaan = $sumrekapopd - $NilaiAwal2;
        $TambahRincianObjekPenerimaan = $nilai_pagu + $KurangRincianObjekPenerimaan;

        $HasilObjekPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_paguopd')
                            ->where(['opdpenerimaan.bulan_id' => $request->create_bulan_id,])
                            ->where(['opdpenerimaan.id_opd' => $request->create_id_opd,])
                            ->where(['opdpenerimaan.id_akun' => $request->create_akun,])
                            ->where(['opdpenerimaan.id_kelompok' => $request->create_kelompok,])
                            ->where(['opdpenerimaan.kd_jenis' => $request->create_jenis,])
                            ->where(['opdpenerimaan.kd_objek' => $request->create_Objek,])
                            ->get();

        $sumObjekPenerimaan = $HasilObjekPenerimaan->sum('nilai_paguopd');
        $KurangObjekPenerimaan = $sumObjekPenerimaan - $NilaiAwal2;
        $TambahObjekPenerimaan = $nilai_pagu + $KurangObjekPenerimaan;

        $HasilJenisPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_paguopd')
                            ->where(['opdpenerimaan.bulan_id' => $request->create_bulan_id,])
                            ->where(['opdpenerimaan.id_opd' => $request->create_id_opd,])
                            ->where(['opdpenerimaan.id_akun' => $request->create_akun,])
                            ->where(['opdpenerimaan.id_kelompok' => $request->create_kelompok,])
                            ->where(['opdpenerimaan.kd_jenis' => $request->create_jenis,])
                            ->get();

        $sumJenisPenerimaan = $HasilJenisPenerimaan->sum('nilai_paguopd');
        $KurangJenisPenerimaan = $sumJenisPenerimaan - $NilaiAwal2;
        $TambahJenisPenerimaan = $nilai_pagu + $KurangJenisPenerimaan;

        $HasilKelompokPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_paguopd')
                            ->where(['opdpenerimaan.bulan_id' => $request->create_bulan_id,])
                            ->where(['opdpenerimaan.id_opd' => $request->create_id_opd,])
                            ->where(['opdpenerimaan.id_akun' => $request->create_akun,])
                            ->where(['opdpenerimaan.id_kelompok' => $request->create_kelompok,])
                            ->get();

        $sumKelompokPenerimaan = $HasilKelompokPenerimaan->sum('nilai_paguopd');
        $KurangKelompokPenerimaan = $sumKelompokPenerimaan - $NilaiAwal2;
        $TambahKelompokPenerimaan = $nilai_pagu + $KurangKelompokPenerimaan;

        $HasilBulanPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_paguopd')
                            ->where(['opdpenerimaan.bulan_id' => $request->create_bulan_id,])
                            ->where(['opdpenerimaan.id_opd' => $request->create_id_opd,])
                            ->get();

        $sumBulanPenerimaan = $HasilBulanPenerimaan->sum('nilai_paguopd');
        $KurangBulanPenerimaan = $sumBulanPenerimaan - $NilaiAwal2;
        $TambahBulanPenerimaan = $nilai_pagu + $KurangBulanPenerimaan;



        if($validator->passes()){

            $OPDPenerimaan = OPDPenerimaan::findOrFail($request->create_id);
            $OPDPenerimaan->nilai_paguopd = $nilai_pagu;
            $OPDPenerimaan->save();

            $RincianObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop);
            $RincianObjekPenerimaan->nilai_pagurincian = $TambahRincianObjekPenerimaan;
            $RincianObjekPenerimaan->save();

            $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop);
            $ObjekPenerimaan->nilai_paguobjek = $TambahObjekPenerimaan;
            $ObjekPenerimaan->save();

            $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp);
            $JenisPenerimaan->nilai_pagujenis = $TambahJenisPenerimaan;
            $JenisPenerimaan->save();

            $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp);
            $KelompokPenerimaan->nilai_pagukelompok = $TambahKelompokPenerimaan;
            $KelompokPenerimaan->save();

            $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn);
            $BulanPenerimaan->nilai_pagubulan = $TambahBulanPenerimaan;
            $BulanPenerimaan->save();



        }
        else {
        return response()->json($validator->errors(), 422);
        }

    }

}
