<?php

namespace App\Http\Controllers;

use App\Models\Bku;
use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\BKUAkun;
use App\Models\Rekanan;
use App\Models\BKUJenis;
use App\Models\BKUObjek;
use App\Models\BKUKelompok;
use App\Models\KodeRekening;
use Illuminate\Http\Request;
use App\Models\OPDPenerimaan;
use Illuminate\Support\Carbon;
use App\Models\BKURincianobjek;
use App\Models\BulanPenerimaan;
use App\Models\JenisPenerimaan;
use App\Models\ObjekPenerimaan;
use App\Models\SubRincianObjek;
use Illuminate\Http\JsonResponse;
use App\Models\BKUSubrincianobjek;
use App\Models\KelompokPenerimaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RincianObjekPenerimaan;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class BkuPenerimaanController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view Danas', only: ['index']),
            new Middleware('permission:edit Danas', only: ['edit']),
            new Middleware('permission:create Danas', only: ['create']),
            new Middleware('permission:delete Danas', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $opd = Opd::all();
        $bank = Bank::all();
        $cari_nilai_sts = str_replace('.','',$request->cari_nilai_sts);
        if ($request->ajax()) {
            // $data = BkuPenerimaan::query();

                $data = Bku::join('sub_rincianobjek', 'sub_rincianobjek.id', '=' ,'bku.kd_subrincianobjek')
                ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.*', 'sub_rincianobjek.uraian_subrincianobjek', 'opd.uraian_skpd', 'bank.kode_bank')
                ->where('bku.bulan','like',"%".$request->cari_bulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.no_bku','like',"%".$request->cari_no_bku."%")
                ->where('bku.no_rekening','like',"%".$request->cari_no_rekening."%")
                ->where('bku.nilai_sts','like',"%".$cari_nilai_sts."%")
                ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editbaru editPenerimaan"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           if($row->aktif=='N'){
                            $btn.=' <a class="btn btn-sm btn-outline-danger waves-effect waves-light banrecord"  data-id="'.$row->id.'" href="javascript:void(0)"><i class="mdi mdi-close-box mr-2"></i>Batal</a>';
                            }if  ($row->aktif=='Y') {
                                $btn.=' <a class="btn btn-sm btn-outline-warning waves-effect waves-light unbanrecord"  data-id="'.$row->id.'" href="javascript:void(0)"><i class="mdi mdi-close-box mr-2"></i>UnBatal</a>';
                            } return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('penerimaan.list',[
            'opd' => $opd,
            'bank' => $bank,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $BkuAkun = BKUAkun::all();
        $opd = Opd::all();
        $bank = Bank::all();
        $subrincianobjek = SubRincianObjek::all();
        $rekanan = Rekanan::all();
        return view('penerimaan.create',[
            'opd' => $opd,
            'bank' => $bank,
            'subrincianobjek' => $subrincianobjek,
            'BkuAkun' => $BkuAkun,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'create_no_bku' => 'required',
            'create_tgl_sts' => 'required',
            // 'create_no_rekening' => 'required',
            'create_tanggal_bku' => 'required',
            'create_uraian_bku' => 'required',
            'create_id_opd' => 'required',
            'create_subrincianObjek' => 'required',
            'create_id_bank' => 'required',
            'create_nilai_sts' => 'required',
        ],
        [
            'create_no_bku' => 'Nomer STS Masih Kosong',
            'create_tgl_sts' => 'Tanggal STS Masih Kosong',
            // 'create_no_rekening' => 'Nomer Rekening Masih Kosong',
            'create_tanggal_bku' => 'Tanggal Kas Masih Kosong',
            'create_uraian_bku' => 'Uraian sts Masih Kosong',
            'create_id_opd' => 'Nama OPD Masih Kosong',
            'create_subrincianObjek' => 'Nomer Rekening Masih Kosong',
            'create_id_bank' => 'Nama Bank Masih Kosong',
            'create_nilai_sts' => 'Nilai sts Masih Kosong',
        ]);
        $validatordouble = Validator::make($request->all(), [
            'double_no_bku' => 'required',
         ],
         [
             'double_no_bku' => 'Nomer sts Sudah Ada',
         ]);
        if($validator->passes()){
            $create_tanggal_bku1 = $request->create_tanggal_bku;
            $create_tanggal_bku33 = Carbon::make($create_tanggal_bku1)->format("F");
            $create_tanggal_bku4 = Carbon::make($create_tanggal_bku1)->format("m");
            $q=DB::table("bku")->select(DB::raw("COUNT(kd_bku) as jumlah"));
            if ($q->count() >0){
                foreach($q->get() as $k){
                    $create_tanggal_bku4 = Carbon::make($create_tanggal_bku1)->format("n");
                    $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                    $nomor = sprintf("%06s", abs(((int)$k->jumlah)+1));
                    $kd = sprintf("%06s", abs(((int)$k->jumlah)+1)). '/' . $bulanRomawi[$create_tanggal_bku4]. '/' ."PENERIMAAN";
                    $create_tgl_sts1 = $request->create_tgl_sts;
                    $create_tgl_sts2 = Carbon::make($create_tgl_sts1)->format("Y-m-d");

                    $create_tanggal_bku1 = $request->create_tanggal_bku;
                    $create_tanggal_bku2 = Carbon::make($create_tanggal_bku1)->format("Y-m-d");
                    $create_tanggal_bku3 = Carbon::make($create_tanggal_bku1)->format("F");
                    $create_tanggal_bku3angka = Carbon::make($create_tanggal_bku1)->format("m");

                    $id = $request->create_subrincianObjek;
                    $Subrincianobjek = BKUSubrincianobjek::findOrFail($id);
                    $no_rekening = $Subrincianobjek->kode_subrincianobjek;

                    $unit = $request->create_no_bku;
                    $cek = Bku::where(['no_bku' => $unit,])->first();
                    if (!$cek) {
                        $BkuPenerimaan = new Bku;
                        $BkuPenerimaan->kd_bku = $nomor;
                        $BkuPenerimaan->id_bku = $kd;
                        $BkuPenerimaan->no_bku = $request->create_no_bku;
                        $BkuPenerimaan->no_rekening = $no_rekening;
                        $BkuPenerimaan->tgl_sts = $create_tgl_sts2;
                        $BkuPenerimaan->tanggal_bku = $create_tanggal_bku2;
                        $BkuPenerimaan->uraian_bku = $request->create_uraian_bku;
                        $BkuPenerimaan->id_opd = $request->create_id_opd;
                        $BkuPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                        $BkuPenerimaan->id_bank = $request->create_id_bank;
                        $BkuPenerimaan->nilai_sts = str_replace('.','',$request->create_nilai_sts);
                        $BkuPenerimaan->bulan_id = $create_tanggal_bku3angka;
                        $BkuPenerimaan->bulan = $create_tanggal_bku3;
                        $BkuPenerimaan->aktif_bku = 'PENERIMAAN';
                        $BkuPenerimaan->save();

                        if ($request->create_no_bku) {
                            $idbn = $create_tanggal_bku3angka. $request->create_id_opd;
                            $idkp = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok;
                            $idjp = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis;
                            $idop = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek;
                            $idrop = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek. $request->create_rincianObjek;
                            $idopdpenerimaan = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek. $request->create_rincianObjek. $request->create_subrincianObjek;
                            $BulanPenerimaan = BulanPenerimaan::select('bulanpenerimaan.nilai_realisasibulan')
                            ->where('bulanpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['bulanpenerimaan.id' => $idbn,])
                            ->get();
                            $sumrekapbulan = $BulanPenerimaan->sum('nilai_realisasibulan');
                            $nilai_realisasibulan = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagubulan = $nilai_realisasibulan + $sumrekapbulan;
                            $cekBulanPenerimaan = BulanPenerimaan::where(['id' => $idbn,])->first();

                            $KelompokPenerimaan = KelompokPenerimaan::select('kelompokpenerimaan.nilai_realisasikelompok')
                            ->where('kelompokpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['kelompokpenerimaan.id' => $idkp,])
                            ->get();
                            $sumrekapkelompok = $KelompokPenerimaan->sum('nilai_realisasikelompok');
                            $nilai_realisasikelompok = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagukelompok = $nilai_realisasikelompok + $sumrekapkelompok;
                            $cekKelompokPenerimaan = KelompokPenerimaan::where(['id' => $idkp,])->first();
                            $idBKUKelompok = BKUKelompok::where(['id' => $request->create_kelompok,])->first();

                            $JenisPenerimaan = JenisPenerimaan::select('jenispenerimaan.nilai_realisasijenis')
                            ->where('jenispenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['jenispenerimaan.id' => $idjp,])
                            ->get();
                            $sumrekapObjek = $JenisPenerimaan->sum('nilai_realisasijenis');
                            $nilai_realisasijenis = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagujenis = $nilai_realisasijenis + $sumrekapObjek;
                            $cekJenisPenerimaan = JenisPenerimaan::where(['id' => $idjp,])->first();
                            $idBKUJenis = BKUJenis::where(['id' => $request->create_jenis,])->first();

                            $ObjekPenerimaan = ObjekPenerimaan::select('objekpenerimaan.nilai_realisasiobjek')
                            ->where('objekpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['objekpenerimaan.id' => $idop,])
                            ->get();
                            $sumrekapObjek = $ObjekPenerimaan->sum('nilai_realisasiobjek');
                            $nilai_realisasiobjek = str_replace('.','',$request->create_nilai_sts);
                            $nilaipaguobjek = $nilai_realisasiobjek + $sumrekapObjek;
                            $cekObjekPenerimaan = ObjekPenerimaan::where(['id' => $idop,])->first();
                            $idBKUObjek = BKUObjek::where(['id' => $request->create_Objek,])->first();

                            $RincianObjekPenerimaan = RincianObjekPenerimaan::select('rincianobjekpenerimaan.nilai_realisasirincian')
                            ->where('rincianobjekpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['rincianobjekpenerimaan.id' => $idrop,])
                            ->get();
                            $sumrekaprincian = $RincianObjekPenerimaan->sum('nilai_realisasirincian');
                            $nilai_realisasirincian = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagurincian = $nilai_realisasirincian + $sumrekaprincian;
                            $cekRincianObjekPenerimaan = RincianObjekPenerimaan::where(['id' => $idrop,])->first();
                            $idBKURincianobjek = BKURincianobjek::where(['id' => $request->create_rincianObjek,])->first();

                            $HasilopdPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_realisasiopd')
                            ->where('opdpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['opdpenerimaan.id' => $idopdpenerimaan,])
                            ->get();
                            $sumrekapopd = $HasilopdPenerimaan->sum('nilai_realisasiopd');
                            $nilai_realisasiopd = str_replace('.','',$request->create_nilai_sts);
                            $nilaipaguopd = $nilai_realisasiopd + $sumrekapopd;

                            $cekOPDPenerimaan = OPDPenerimaan::where(['id' => $idopdpenerimaan,])->first();
                            $idopd = $request->create_id_opd;
                            if (!$cekOPDPenerimaan) {
                                $OPDPenerimaan = new OPDPenerimaan;
                                $OPDPenerimaan->id = $idopdpenerimaan;
                                $OPDPenerimaan->id_rop = $idrop;
                                $OPDPenerimaan->id_opd = $request->create_id_opd;
                                $OPDPenerimaan->id_akun = $request->create_akun;
                                $OPDPenerimaan->id_kelompok = $request->create_kelompok;
                                $OPDPenerimaan->kd_jenis = $request->create_jenis;
                                $OPDPenerimaan->kd_objek = $request->create_Objek;
                                $OPDPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $OPDPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                                $OPDPenerimaan->no_rekening = $no_rekening;
                                $OPDPenerimaan->nilai_realisasiopd = $nilaipaguopd;
                                $OPDPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $OPDPenerimaan->bulan = $create_tanggal_bku3;
                                $OPDPenerimaan->save();

                                $Yes = OPD::find($idopd);
                                $Yes->aktif_penerimaan = 'Y';
                                $Yes->save();

                            } else {
                                $OPDPenerimaan = OPDPenerimaan::findOrFail($idopdpenerimaan);
                                $OPDPenerimaan->id_rop = $idrop;
                                $OPDPenerimaan->id_opd = $request->create_id_opd;
                                $OPDPenerimaan->id_akun = $request->create_akun;
                                $OPDPenerimaan->id_kelompok = $request->create_kelompok;
                                $OPDPenerimaan->kd_jenis = $request->create_jenis;
                                $OPDPenerimaan->kd_objek = $request->create_Objek;
                                $OPDPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $OPDPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                                $OPDPenerimaan->no_rekening = $no_rekening;
                                $OPDPenerimaan->nilai_realisasiopd = $nilaipaguopd;
                                $OPDPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $OPDPenerimaan->bulan = $create_tanggal_bku3;
                                $OPDPenerimaan->save();

                                $Yes = OPD::find($idopd);
                                $Yes->aktif_penerimaan = 'Y';
                                $Yes->save();

                            }
                            if (!$cekRincianObjekPenerimaan) {
                                $RincianObjekPenerimaan = new RincianObjekPenerimaan;
                                $RincianObjekPenerimaan->id = $idrop;
                                $RincianObjekPenerimaan->id_op = $idop;
                                $RincianObjekPenerimaan->id_opd = $request->create_id_opd;
                                $RincianObjekPenerimaan->id_akun = $request->create_akun;
                                $RincianObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $RincianObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $RincianObjekPenerimaan->kd_objek = $request->create_Objek;
                                $RincianObjekPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $RincianObjekPenerimaan->kode_rincianobjek = $idBKURincianobjek->kode_rincianobjek;
                                $RincianObjekPenerimaan->nilai_realisasirincian = $nilaipagurincian;
                                $RincianObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $RincianObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $RincianObjekPenerimaan->save();
                            } else {
                                $RincianObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop);
                                $RincianObjekPenerimaan->id_op = $idop;
                                $RincianObjekPenerimaan->id_opd = $request->create_id_opd;
                                $RincianObjekPenerimaan->id_akun = $request->create_akun;
                                $RincianObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $RincianObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $RincianObjekPenerimaan->kd_objek = $request->create_Objek;
                                $RincianObjekPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $RincianObjekPenerimaan->kode_rincianobjek = $idBKURincianobjek->kode_rincianobjek;
                                $RincianObjekPenerimaan->nilai_realisasirincian = $nilaipagurincian;
                                $RincianObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $RincianObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $RincianObjekPenerimaan->save();
                            }
                            if (!$cekObjekPenerimaan) {
                                $ObjekPenerimaan = new ObjekPenerimaan;
                                $ObjekPenerimaan->id = $idop;
                                $ObjekPenerimaan->id_jp = $idjp;
                                $ObjekPenerimaan->id_opd = $request->create_id_opd;
                                $ObjekPenerimaan->id_akun = $request->create_akun;
                                $ObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $ObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $ObjekPenerimaan->kd_objek = $request->create_Objek;
                                $ObjekPenerimaan->kode_objek = $idBKUObjek->kode_objek;
                                $ObjekPenerimaan->nilai_realisasiobjek = $nilaipaguobjek;
                                $ObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $ObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $ObjekPenerimaan->save();
                            } else {
                                $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop);
                                $ObjekPenerimaan->id_jp = $idjp;
                                $ObjekPenerimaan->id_opd = $request->create_id_opd;
                                $ObjekPenerimaan->id_akun = $request->create_akun;
                                $ObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $ObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $ObjekPenerimaan->kd_objek = $request->create_Objek;
                                $ObjekPenerimaan->kode_objek = $idBKUObjek->kode_objek;
                                $ObjekPenerimaan->nilai_realisasiobjek = $nilaipaguobjek;
                                $ObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $ObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $ObjekPenerimaan->save();
                            }
                            if (!$cekJenisPenerimaan) {
                                $JenisPenerimaan = new JenisPenerimaan;
                                $JenisPenerimaan->id = $idjp;
                                $JenisPenerimaan->id_kp = $idkp;
                                $JenisPenerimaan->id_opd = $request->create_id_opd;
                                $JenisPenerimaan->id_akun = $request->create_akun;
                                $JenisPenerimaan->id_kelompok = $request->create_kelompok;
                                $JenisPenerimaan->kd_jenis = $request->create_jenis;
                                $JenisPenerimaan->kode_jenis = $idBKUJenis->kode_jenis;
                                $JenisPenerimaan->nilai_realisasijenis = $nilaipagujenis;
                                $JenisPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $JenisPenerimaan->bulan = $create_tanggal_bku3;
                                $JenisPenerimaan->save();
                            } else {
                                $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp);
                                $JenisPenerimaan->id_kp = $idkp;
                                $JenisPenerimaan->id_opd = $request->create_id_opd;
                                $JenisPenerimaan->id_akun = $request->create_akun;
                                $JenisPenerimaan->id_kelompok = $request->create_kelompok;
                                $JenisPenerimaan->kd_jenis = $request->create_jenis;
                                $JenisPenerimaan->kode_jenis = $idBKUJenis->kode_jenis;
                                $JenisPenerimaan->nilai_realisasijenis = $nilaipagujenis;
                                $JenisPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $JenisPenerimaan->bulan = $create_tanggal_bku3;
                                $JenisPenerimaan->save();
                            }
                            if (!$cekKelompokPenerimaan) {
                                $KelompokPenerimaan = new KelompokPenerimaan;
                                $KelompokPenerimaan->id = $idkp;
                                $KelompokPenerimaan->id_opd = $request->create_id_opd;
                                $KelompokPenerimaan->id_akun = $request->create_akun;
                                $KelompokPenerimaan->id_kelompok = $request->create_kelompok;
                                $KelompokPenerimaan->kode_kelompok = $idBKUKelompok->kode_kelompok;
                                $KelompokPenerimaan->nilai_realisasikelompok = $nilaipagukelompok;
                                $KelompokPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $KelompokPenerimaan->bulan = $create_tanggal_bku3;
                                $KelompokPenerimaan->save();
                            } else {
                                $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp);
                                $KelompokPenerimaan->id_opd = $request->create_id_opd;
                                $KelompokPenerimaan->id_akun = $request->create_akun;
                                $KelompokPenerimaan->id_kelompok = $request->create_kelompok;
                                $KelompokPenerimaan->kode_kelompok = $idBKUKelompok->kode_kelompok;
                                $KelompokPenerimaan->nilai_realisasikelompok = $nilaipagukelompok;
                                $KelompokPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $KelompokPenerimaan->bulan = $create_tanggal_bku3;
                                $KelompokPenerimaan->save();
                            }
                             if (!$cekBulanPenerimaan) {
                                    $BulanPenerimaan = new BulanPenerimaan;
                                    $BulanPenerimaan->id = $idbn;
                                    $BulanPenerimaan->id_opd = $request->create_id_opd;
                                    $BulanPenerimaan->nilai_realisasibulan = $nilaipagubulan;
                                    $BulanPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                    $BulanPenerimaan->bulan = $create_tanggal_bku3;
                                    $BulanPenerimaan->save();
                                } else {
                                    $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn);
                                    $BulanPenerimaan->id_opd = $request->create_id_opd;
                                    $BulanPenerimaan->nilai_realisasibulan = $nilaipagubulan;
                                    $BulanPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                    $BulanPenerimaan->bulan = $create_tanggal_bku3;
                                    $BulanPenerimaan->save();
                                }

                            $no_bku = $request->create_no_bku;
                            $Penerimaan=DB::table("bku")->where('bku.no_bku', $no_bku)
                            ->get();
                            if ($Penerimaan){
                            foreach($Penerimaan as $k)
                            {
                            $saya = $k->id;

                            $BkuPenerimaan = Bku::findOrFail($saya);

                            return view('penerimaan.show',[
                                'BkuPenerimaan' => $BkuPenerimaan,
                            ]);
                            }}
                        }
                        return redirect()->route('bku-penerimaan.index')->with('success','Penerimaan added successfully.');
                    }
                    else {
                        return response()->json($validatordouble->errors(), 422);
                    }

                }
            }
            else {
                $unit = $request->create_no_bku;
                $cek = Bku::where(['no_bku' => $unit,])->first();
                if (!$cek) {

                    $BkuPenerimaan = new Bku;
                    $create_tgl_sts1 = $request->create_tgl_sts;
                    $create_tgl_sts2 = Carbon::make($create_tgl_sts1)->format("Y-m-d");

                    $create_tanggal_bku1 = $request->create_tanggal_bku;
                    $create_tanggal_bku2 = Carbon::make($create_tanggal_bku1)->format("Y-m-d");
                    $create_tanggal_bku3 = Carbon::make($create_tanggal_bku1)->format("F");
                    $create_tanggal_bku4 = Carbon::make($create_tanggal_bku1)->format("n");
                    $create_tanggal_bku3angka = Carbon::make($create_tanggal_bku1)->format("m");
                    $num = 1;

                    $id = $request->create_subrincianObjek;
                    $Subrincianobjek = BKUSubrincianobjek::findOrFail($id);
                    $no_rekening = $Subrincianobjek->kode_subrincianobjek;

                            // $kd = $num."/";
                    $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                    $nomor = sprintf("%06s", $num);
                    $kd = sprintf("%06s", $num). '/' . $bulanRomawi[$create_tanggal_bku4]. '/' ."PENERIMAAN";
                    if($kd){
                        $BkuPenerimaan->kd_bku = $nomor;
                        $BkuPenerimaan->id_bku = $kd;
                        $BkuPenerimaan->no_bku = $request->create_no_bku;
                        $BkuPenerimaan->no_rekening = $no_rekening;
                        $BkuPenerimaan->tgl_sts = $create_tgl_sts2;
                        $BkuPenerimaan->tanggal_bku = $create_tanggal_bku2;
                        $BkuPenerimaan->uraian_bku = $request->create_uraian_bku;
                        $BkuPenerimaan->id_opd = $request->create_id_opd;
                        $BkuPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                        $BkuPenerimaan->id_bank = $request->create_id_bank;
                        $BkuPenerimaan->nilai_sts = str_replace('.','',$request->create_nilai_sts);
                        $BkuPenerimaan->bulan = $create_tanggal_bku3;
                        $BkuPenerimaan->aktif_bku = 'PENERIMAAN';
                        $BkuPenerimaan->save();
                        if ($request->create_no_bku) {
                            $idbn = $create_tanggal_bku3angka. $request->create_id_opd;
                            $idkp = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok;
                            $idjp = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis;
                            $idop = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek;
                            $idrop = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek. $request->create_rincianObjek;
                            $idopdpenerimaan = $create_tanggal_bku3angka. $request->create_id_opd. $request->create_akun. $request->create_kelompok. $request->create_jenis. $request->create_Objek. $request->create_rincianObjek. $request->create_subrincianObjek;
                            $BulanPenerimaan = BulanPenerimaan::select('bulanpenerimaan.nilai_realisasibulan')
                            ->where('bulanpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['bulanpenerimaan.id' => $idbn,])
                            ->get();
                            $sumrekapbulan = $BulanPenerimaan->sum('nilai_realisasibulan');
                            $nilai_realisasibulan = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagubulan = $nilai_realisasibulan + $sumrekapbulan;
                            $cekBulanPenerimaan = BulanPenerimaan::where(['id' => $idbn,])->first();

                            $KelompokPenerimaan = KelompokPenerimaan::select('kelompokpenerimaan.nilai_realisasikelompok')
                            ->where('kelompokpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['kelompokpenerimaan.id' => $idkp,])
                            ->get();
                            $sumrekapkelompok = $KelompokPenerimaan->sum('nilai_realisasikelompok');
                            $nilai_realisasikelompok = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagukelompok = $nilai_realisasikelompok + $sumrekapkelompok;
                            $cekKelompokPenerimaan = KelompokPenerimaan::where(['id' => $idkp,])->first();
                            $idBKUKelompok = BKUKelompok::where(['id' => $request->create_kelompok,])->first();

                            $JenisPenerimaan = JenisPenerimaan::select('jenispenerimaan.nilai_realisasijenis')
                            ->where('jenispenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['jenispenerimaan.id' => $idjp,])
                            ->get();
                            $sumrekapObjek = $JenisPenerimaan->sum('nilai_realisasijenis');
                            $nilai_realisasijenis = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagujenis = $nilai_realisasijenis + $sumrekapObjek;
                            $cekJenisPenerimaan = JenisPenerimaan::where(['id' => $idjp,])->first();
                            $idBKUJenis = BKUJenis::where(['id' => $request->create_jenis,])->first();

                            $ObjekPenerimaan = ObjekPenerimaan::select('objekpenerimaan.nilai_realisasiobjek')
                            ->where('objekpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['objekpenerimaan.id' => $idop,])
                            ->get();
                            $sumrekapObjek = $ObjekPenerimaan->sum('nilai_realisasiobjek');
                            $nilai_realisasiobjek = str_replace('.','',$request->create_nilai_sts);
                            $nilaipaguobjek = $nilai_realisasiobjek + $sumrekapObjek;
                            $cekObjekPenerimaan = ObjekPenerimaan::where(['id' => $idop,])->first();
                            $idBKUObjek = BKUObjek::where(['id' => $request->create_Objek,])->first();

                            $RincianObjekPenerimaan = RincianObjekPenerimaan::select('rincianobjekpenerimaan.nilai_realisasirincian')
                            ->where('rincianobjekpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['rincianobjekpenerimaan.id' => $idrop,])
                            ->get();
                            $sumrekaprincian = $RincianObjekPenerimaan->sum('nilai_realisasirincian');
                            $nilai_realisasirincian = str_replace('.','',$request->create_nilai_sts);
                            $nilaipagurincian = $nilai_realisasirincian + $sumrekaprincian;
                            $cekRincianObjekPenerimaan = RincianObjekPenerimaan::where(['id' => $idrop,])->first();
                            $idBKURincianobjek = BKURincianobjek::where(['id' => $request->create_rincianObjek,])->first();

                            $HasilopdPenerimaan = OPDPenerimaan::select('opdpenerimaan.nilai_realisasiopd')
                            ->where('opdpenerimaan.bulan','like', "%".$request->create_bulan."%")
                            ->where(['opdpenerimaan.id' => $idopdpenerimaan,])
                            ->get();
                            $sumrekapopd = $HasilopdPenerimaan->sum('nilai_realisasiopd');
                            $nilai_realisasiopd = str_replace('.','',$request->create_nilai_sts);
                            $nilaipaguopd = $nilai_realisasiopd + $sumrekapopd;

                            $cekOPDPenerimaan = OPDPenerimaan::where(['id' => $idopdpenerimaan,])->first();
                            $idopd = $request->create_id_opd;
                            if (!$cekOPDPenerimaan) {
                                $OPDPenerimaan = new OPDPenerimaan;
                                $OPDPenerimaan->id = $idopdpenerimaan;
                                $OPDPenerimaan->id_rop = $idrop;
                                $OPDPenerimaan->id_opd = $request->create_id_opd;
                                $OPDPenerimaan->id_akun = $request->create_akun;
                                $OPDPenerimaan->id_kelompok = $request->create_kelompok;
                                $OPDPenerimaan->kd_jenis = $request->create_jenis;
                                $OPDPenerimaan->kd_objek = $request->create_Objek;
                                $OPDPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $OPDPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                                $OPDPenerimaan->no_rekening = $no_rekening;
                                $OPDPenerimaan->nilai_realisasiopd = $nilaipaguopd;
                                $OPDPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $OPDPenerimaan->bulan = $create_tanggal_bku3;
                                $OPDPenerimaan->save();

                                $Yes = OPD::find($idopd);
                                $Yes->aktif_penerimaan = 'Y';
                                $Yes->save();
                            } else {
                                $OPDPenerimaan = OPDPenerimaan::findOrFail($idopdpenerimaan);
                                $OPDPenerimaan->id_rop = $idrop;
                                $OPDPenerimaan->id_opd = $request->create_id_opd;
                                $OPDPenerimaan->id_akun = $request->create_akun;
                                $OPDPenerimaan->id_kelompok = $request->create_kelompok;
                                $OPDPenerimaan->kd_jenis = $request->create_jenis;
                                $OPDPenerimaan->kd_objek = $request->create_Objek;
                                $OPDPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $OPDPenerimaan->kd_subrincianobjek = $request->create_subrincianObjek;
                                $OPDPenerimaan->no_rekening = $no_rekening;
                                $OPDPenerimaan->nilai_realisasiopd = $nilaipaguopd;
                                $OPDPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $OPDPenerimaan->bulan = $create_tanggal_bku3;
                                $OPDPenerimaan->save();

                                $Yes = OPD::find($idopd);
                                $Yes->aktif_penerimaan = 'Y';
                                $Yes->save();
                            }

                            if (!$cekRincianObjekPenerimaan) {
                                $RincianObjekPenerimaan = new RincianObjekPenerimaan;
                                $RincianObjekPenerimaan->id = $idrop;
                                $RincianObjekPenerimaan->id_op = $idop;
                                $RincianObjekPenerimaan->id_opd = $request->create_id_opd;
                                $RincianObjekPenerimaan->id_akun = $request->create_akun;
                                $RincianObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $RincianObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $RincianObjekPenerimaan->kd_objek = $request->create_Objek;
                                $RincianObjekPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $RincianObjekPenerimaan->kode_rincianobjek = $idBKURincianobjek->kode_rincianobjek;
                                $RincianObjekPenerimaan->nilai_realisasirincian = $nilaipagurincian;
                                $RincianObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $RincianObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $RincianObjekPenerimaan->save();
                            } else {
                                $RincianObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop);
                                $RincianObjekPenerimaan->id_op = $idop;
                                $RincianObjekPenerimaan->id_opd = $request->create_id_opd;
                                $RincianObjekPenerimaan->id_akun = $request->create_akun;
                                $RincianObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $RincianObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $RincianObjekPenerimaan->kd_objek = $request->create_Objek;
                                $RincianObjekPenerimaan->kd_rincianobjek = $request->create_rincianObjek;
                                $RincianObjekPenerimaan->kode_rincianobjek = $idBKURincianobjek->kode_rincianobjek;
                                $RincianObjekPenerimaan->nilai_realisasirincian = $nilaipagurincian;
                                $RincianObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $RincianObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $RincianObjekPenerimaan->save();
                            }
                            if (!$cekObjekPenerimaan) {
                                $ObjekPenerimaan = new ObjekPenerimaan;
                                $ObjekPenerimaan->id = $idop;
                                $ObjekPenerimaan->id_jp = $idjp;
                                $ObjekPenerimaan->id_opd = $request->create_id_opd;
                                $ObjekPenerimaan->id_akun = $request->create_akun;
                                $ObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $ObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $ObjekPenerimaan->kd_objek = $request->create_Objek;
                                $ObjekPenerimaan->kode_objek = $idBKUObjek->kode_objek;
                                $ObjekPenerimaan->nilai_realisasiobjek = $nilaipaguobjek;
                                $ObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $ObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $ObjekPenerimaan->save();
                            } else {
                                $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop);
                                $ObjekPenerimaan->id_jp = $idjp;
                                $ObjekPenerimaan->id_opd = $request->create_id_opd;
                                $ObjekPenerimaan->id_akun = $request->create_akun;
                                $ObjekPenerimaan->id_kelompok = $request->create_kelompok;
                                $ObjekPenerimaan->kd_jenis = $request->create_jenis;
                                $ObjekPenerimaan->kd_objek = $request->create_Objek;
                                $ObjekPenerimaan->kode_objek = $idBKUObjek->kode_objek;
                                $ObjekPenerimaan->nilai_realisasiobjek = $nilaipaguobjek;
                                $ObjekPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $ObjekPenerimaan->bulan = $create_tanggal_bku3;
                                $ObjekPenerimaan->save();
                            }
                            if (!$cekJenisPenerimaan) {
                                $JenisPenerimaan = new JenisPenerimaan;
                                $JenisPenerimaan->id = $idjp;
                                $JenisPenerimaan->id_kp = $idkp;
                                $JenisPenerimaan->id_opd = $request->create_id_opd;
                                $JenisPenerimaan->id_akun = $request->create_akun;
                                $JenisPenerimaan->id_kelompok = $request->create_kelompok;
                                $JenisPenerimaan->kd_jenis = $request->create_jenis;
                                $JenisPenerimaan->kode_jenis = $idBKUJenis->kode_jenis;
                                $JenisPenerimaan->nilai_realisasijenis = $nilaipagujenis;
                                $JenisPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $JenisPenerimaan->bulan = $create_tanggal_bku3;
                                $JenisPenerimaan->save();
                            } else {
                                $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp);
                                $JenisPenerimaan->id_kp = $idkp;
                                $JenisPenerimaan->id_opd = $request->create_id_opd;
                                $JenisPenerimaan->id_akun = $request->create_akun;
                                $JenisPenerimaan->id_kelompok = $request->create_kelompok;
                                $JenisPenerimaan->kd_jenis = $request->create_jenis;
                                $JenisPenerimaan->kode_jenis = $idBKUJenis->kode_jenis;
                                $JenisPenerimaan->nilai_realisasijenis = $nilaipagujenis;
                                $JenisPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $JenisPenerimaan->bulan = $create_tanggal_bku3;
                                $JenisPenerimaan->save();
                            }
                            if (!$cekKelompokPenerimaan) {
                                $KelompokPenerimaan = new KelompokPenerimaan;
                                $KelompokPenerimaan->id = $idkp;
                                $KelompokPenerimaan->id_opd = $request->create_id_opd;
                                $KelompokPenerimaan->id_akun = $request->create_akun;
                                $KelompokPenerimaan->id_kelompok = $request->create_kelompok;
                                $KelompokPenerimaan->kode_kelompok = $idBKUKelompok->kode_kelompok;
                                $KelompokPenerimaan->nilai_realisasikelompok = $nilaipagukelompok;
                                $KelompokPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $KelompokPenerimaan->bulan = $create_tanggal_bku3;
                                $KelompokPenerimaan->save();
                            } else {
                                $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp);
                                $KelompokPenerimaan->id_opd = $request->create_id_opd;
                                $KelompokPenerimaan->id_akun = $request->create_akun;
                                $KelompokPenerimaan->id_kelompok = $request->create_kelompok;
                                $KelompokPenerimaan->kode_kelompok = $idBKUKelompok->kode_kelompok;
                                $KelompokPenerimaan->nilai_realisasikelompok = $nilaipagukelompok;
                                $KelompokPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                $KelompokPenerimaan->bulan = $create_tanggal_bku3;
                                $KelompokPenerimaan->save();
                            }
                             if (!$cekBulanPenerimaan) {
                                    $BulanPenerimaan = new BulanPenerimaan;
                                    $BulanPenerimaan->id = $idbn;
                                    $BulanPenerimaan->id_opd = $request->create_id_opd;
                                    $BulanPenerimaan->nilai_realisasibulan = $nilaipagubulan;
                                    $BulanPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                    $BulanPenerimaan->bulan = $create_tanggal_bku3;
                                    $BulanPenerimaan->save();
                                } else {
                                    $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn);
                                    $BulanPenerimaan->id_opd = $request->create_id_opd;
                                    $BulanPenerimaan->nilai_realisasibulan = $nilaipagubulan;
                                    $BulanPenerimaan->bulan_id = $create_tanggal_bku3angka;
                                    $BulanPenerimaan->bulan = $create_tanggal_bku3;
                                    $BulanPenerimaan->save();
                                }

                            $no_bku = $request->create_no_bku;
                            $Penerimaan=DB::table("bku")->where('bku.no_bku', $no_bku)
                            ->get();
                            if ($Penerimaan){
                            foreach($Penerimaan as $k)
                            {
                            $saya = $k->id;

                            $BkuPenerimaan = Bku::findOrFail($saya);

                            return view('penerimaan.show',[
                                'BkuPenerimaan' => $BkuPenerimaan,
                            ]);
                            }}
                        }
                        return redirect()->route('bku-penerimaan.index')->with('success','Penerimaan added successfully.');
                    }
                }
                else {
                    return response()->json($validatordouble->errors(), 422);
                }
            }

        }
        else {
            return response()->json($validator->errors(), 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $no_bku = $request->create_no_bku;
        $penerimaan=DB::table("bku")->where('bku.no_bku', $no_bku)
        ->get();
        if ($penerimaan){
        foreach($penerimaan as $k)
        {
        $saya = $k->id;

        // $penerimaan = BkuPenerimaan::where('id', $no_bku);
        $BkuPenerimaan = Bku::findOrFail($saya);
        // return response()->json($BkuPenerimaan);

        // $no_bku = $request->create_no_bku;
        // $BkuPenerimaan=DB::table("bku")->where('no_bku', $no_bku);

        // return view('penerimaan.show',[
        //     'BkuPenerimaan' => $BkuPenerimaan,
        // ]);

        // $BkuPenerimaan = BkuPenerimaan::where('id', $no_bku);
        return view('penerimaan.show',[
            'BkuPenerimaan' => $BkuPenerimaan,
        ]);
        }}
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $BkuPenerimaan = Bku::find($id);
        $Akun1 = $BkuPenerimaan->kd_subrincianobjek;
        $Subrincianobjek = BKUSubrincianobjek::find($Akun1);
        $KodeRekening = KodeRekening::find($Akun1);
        // $Akun = $Subrincianobjek->id_akun;
        // // $Akun = BKUAkun::find($idakun);
        // $id_kelompok = $Subrincianobjek->id_kelompok;
        // $kd_jenis = $Subrincianobjek->kd_jenis;
        // $id_objek = $Subrincianobjek->id_objek;
        // $kd_rincianobjek = $Subrincianobjek->kd_rincianobjek;
        // $kd_subrincianobjek = $Subrincianobjek->kd_subrincianobjek;

        // return response()->json($BkuPenerimaan);

        // $BKUObjek1 = BKUObjek::select('objek.*')
        //     ->where('objek.kode_objek','like', "%".$BKURincianobjek1->kode_objek."%")
        //     ->get();
        // $BKUObjek2 = $BKUObjek1->id;

        // $BKUJenis1 = BKUJenis::select('jenis.*')
        //     ->where('jenis.kode_jenis','like', "%".$BKUObjek1->kode_jenis."%")
        //     ->get();
        // $BKUJenis2 = $BKUJenis1->id;

        // $BKUKelompok1 = BKUKelompok::select('kelompok.*')
        //     ->where('kelompok.kode_kelompok','like', "%".$BKUJenis1->kode_kelompok."%")
        //     ->get();
        // $BKUKelompok2 = $BKUKelompok1->id;

        $BkuAkun = BKUAkun::all();
        $BKUKelompok = BKUKelompok::all();
        $opd = Opd::all();
        $bank = Bank::all();
        return view('penerimaan.edit',[
            'Subrincianobjek' => $Subrincianobjek,

            // 'BKUKelompok1' => $BKUKelompok1,
            // 'BKUJenis1' => $BKUJenis1,
            // 'BKUObjek1' => $BKUObjek1,
            'KodeRekening' => $KodeRekening,

            'BkuPenerimaan' => $BkuPenerimaan,
            'opd' => $opd,
            'bank' => $bank,
            'BkuAkun' => $BkuAkun,
            'BKUKelompok' => $BKUKelompok,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $id = $request->edit_penerimaan_id;
        $BkuPenerimaan = Bku::findOrFail($id);
        $BkuPenerimaan22 = Bku::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'edit_no_bku' => 'required',
            'edit_tgl_sts' => 'required',
            // 'edit_no_rekening' => 'required',
            'edit_tanggal_bku' => 'required',
            'edit_uraian_bku' => 'required',
            'edit_id_opd' => 'required',
            'edit_subrincianObjek' => 'required',
            'edit_id_bank' => 'required',
            'edit_nilai_sts' => 'required',
        ],
        [
            'edit_no_bku' => 'Nomer STS Masih Kosong',
            'edit_tgl_sts' => 'Tanggal STS Masih Kosong',
            // 'edit_no_rekening' => 'Nomer Rekening Masih Kosong',
            'edit_tanggal_bku' => 'Tanggal Kas Masih Kosong',
            'edit_uraian_bku' => 'Uraian sts Masih Kosong',
            'edit_id_opd' => 'Nama OPD Masih Kosong',
            'edit_subrincianObjek' => 'Nomer Rekening Masih Kosong',
            'edit_id_bank' => 'Nama Bank Masih Kosong',
            'edit_nilai_sts' => 'Nilai sts Masih Kosong',
        ]);
        $validatordouble = Validator::make($request->all(), [
            'double_no_bku' => 'required',
         ],
         [
             'double_no_bku' => 'Nomer sts Sudah Ada',
         ]);
        $edit_tanggal_bku1 = $request->edit_tanggal_bku;
        $edit_tanggal_bku2 = Carbon::make($edit_tanggal_bku1)->format("Y-m-d");
        $edit_tanggal_bku3 = Carbon::make($edit_tanggal_bku1)->format("F");
        $edit_tanggal_bku3angka = Carbon::make($edit_tanggal_bku1)->format("m");

        $edit_tgl_sts1 = $request->edit_tgl_sts;
        $edit_tgl_sts2 = Carbon::make($edit_tgl_sts1)->format("Y-m-d");

        $id = $request->edit_subrincianObjek;
        $Subrincianobjek = BKUSubrincianobjek::findOrFail($id);
        $no_rekening = $Subrincianobjek->kode_subrincianobjek;

        $NilaiBKUOPD = Bku::select('bku.nilai_sts')
                            ->where('bku.bulan','like', "%".$request->edit_bulan1."%")
                            ->where(['bku.id_opd' => $request->edit_id_opd1,])
                            ->get();
        $NilaiBKUOPDsum = $NilaiBKUOPD->sum('nilai_sts');
        $NilaiBKUOPD1 = Bku::select('bku.nilai_sts')
                            ->where('bku.bulan','like', "%".$request->edit_bulan1."%")
                            ->where(['bku.id_opd' => $request->edit_id_opd,])
                            ->get();
        $NilaiBKUOPDsum1 = $NilaiBKUOPD1->sum('nilai_sts');


        $barusts = $request->edit_baru_sts;
        $nosts = $request->edit_no_bku;
        $unit = $request->edit_no_bku;
        $cek = Bku::where(['no_bku' => $unit,])->first();
        if($validator->passes()){
            if($nosts == $barusts){
                $BkuPenerimaan->no_bku = $request->edit_no_bku;
                $BkuPenerimaan->no_rekening = $no_rekening;
                $BkuPenerimaan->tgl_sts = $edit_tgl_sts2;
                $BkuPenerimaan->tanggal_bku = $edit_tanggal_bku2;
                $BkuPenerimaan->uraian_bku = $request->edit_uraian_bku;
                $BkuPenerimaan->id_opd = $request->edit_id_opd;
                $BkuPenerimaan->kd_subrincianobjek = $request->edit_subrincianObjek;
                $BkuPenerimaan->id_bank = $request->edit_id_bank;
                $BkuPenerimaan->nilai_sts = str_replace('.','',$request->edit_nilai_sts);
                $BkuPenerimaan->bulan = $edit_tanggal_bku3;
                $BkuPenerimaan->save();
                if ($request->edit_no_bku) {
                    $idbn =  $request->edit_bulan_id. $request->edit_id_opd1;
                    $idbn1 = $edit_tanggal_bku3angka. $request->edit_id_opd;

                    $idkp = $request->edit_bulan_id. $request->edit_id_opd1. $request->edit_BKUAkun1. $request->edit_BKUKelompok1;
                    $idkp1 = $edit_tanggal_bku3angka. $request->edit_id_opd. $request->edit_akun. $request->edit_kelompok;

                    $idjp = $request->edit_bulan_id. $request->edit_id_opd1. $request->edit_BKUAkun1. $request->edit_BKUKelompok1. $request->edit_BKUJenis1;
                    $idjp1 = $edit_tanggal_bku3angka. $request->edit_id_opd. $request->edit_akun. $request->edit_kelompok. $request->edit_jenis;

                    $idop = $request->edit_bulan_id. $request->edit_id_opd1. $request->edit_BKUAkun1. $request->edit_BKUKelompok1. $request->edit_BKUJenis1. $request->edit_BKUObjek1;
                    $idop1 = $edit_tanggal_bku3angka. $request->edit_id_opd. $request->edit_akun. $request->edit_kelompok. $request->edit_jenis. $request->edit_Objek;

                    $idrop = $request->edit_bulan_id. $request->edit_id_opd1. $request->edit_BKUAkun1. $request->edit_BKUKelompok1. $request->edit_BKUJenis1. $request->edit_BKUObjek1. $request->edit_BKURincianobjek1;
                    $idrop1 = $edit_tanggal_bku3angka. $request->edit_id_opd. $request->edit_akun. $request->edit_kelompok. $request->edit_jenis. $request->edit_Objek. $request->edit_rincianobjek;

                    $idsrop = $request->edit_bulan_id. $request->edit_id_opd1. $request->edit_BKUAkun1. $request->edit_BKUKelompok1. $request->edit_BKUJenis1. $request->edit_BKUObjek1. $request->edit_BKURincianobjek1. $request->edit_Subrincianobjek1;
                    $idsrop1 = $edit_tanggal_bku3angka. $request->edit_id_opd. $request->edit_akun. $request->edit_kelompok. $request->edit_jenis. $request->edit_Objek. $request->edit_rincianobjek. $request->edit_subrincianObjek;

                    $nilai_realisasibulan = str_replace('.','',$request->edit_nilai_sts);

                    $bulankurang = $NilaiBKUOPDsum - $BkuPenerimaan22->nilai_sts;
                    $bulantambah1 = $NilaiBKUOPDsum1 + $nilai_realisasibulan;
                    $bulantambah = $nilai_realisasibulan + $bulankurang;
                    $cekidbn = BulanPenerimaan::where(['id' => $idbn1,])->first();
                    if (!$cekidbn) {
                        $BulanPenerimaanBaru = new BulanPenerimaan;
                        $BulanPenerimaanBaru->id = $idbn1;
                        $BulanPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $BulanPenerimaanBaru->nilai_realisasibulan = $nilai_realisasibulan;
                        $BulanPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $BulanPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $BulanPenerimaanBaru->save();

                        $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn);
                        $BulanPenerimaan->nilai_realisasibulan = $bulankurang;
                        $BulanPenerimaan->save();
                    } elseif ($idbn == $idbn1) {
                        $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn);
                        $BulanPenerimaan->nilai_realisasibulan = $bulantambah;
                        $BulanPenerimaan->save();
                    } else {
                        $BulanPenerimaan1 = BulanPenerimaan::findOrFail($idbn);
                        $BulanPenerimaan1->nilai_realisasibulan = $bulankurang;
                        $BulanPenerimaan1->save();

                        $BulanPenerimaan = BulanPenerimaan::findOrFail($idbn1);
                        $BulanPenerimaan->nilai_realisasibulan = $bulantambah1;
                        $BulanPenerimaan->save();
                    }

                    $NilaiBKUKelompok = KelompokPenerimaan::select('kelompokpenerimaan.nilai_realisasikelompok')
                                        ->where('kelompokpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(column: ['kelompokpenerimaan.id_opd' => $request->edit_id_opd1,])
                                        ->where(column: ['kelompokpenerimaan.id_akun' => $request->edit_BKUAkun1,])
                                        ->where(column: ['kelompokpenerimaan.id_kelompok' => $request->edit_BKUKelompok1,])
                                        ->get();
                    $NilaiBKUKelompoksum = $NilaiBKUKelompok->sum('nilai_realisasikelompok');
                    $NilaiBKUKelompok1 = KelompokPenerimaan::select('kelompokpenerimaan.nilai_realisasikelompok')
                                        ->where('kelompokpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(['kelompokpenerimaan.id_opd' => $request->edit_id_opd,])
                                        ->where(column: ['kelompokpenerimaan.id_akun' => $request->edit_akun,])
                                        ->where(column: ['kelompokpenerimaan.id_kelompok' => $request->edit_kelompok,])
                                        ->get();
                    $NilaiBKUKelompoksum1 = $NilaiBKUKelompok1->sum('nilai_realisasikelompok');

                    $idBKUKelompok = BKUKelompok::where(['id' => $request->edit_kelompok,])->first();
                    $kelompokkurang = $NilaiBKUKelompoksum - $BkuPenerimaan22->nilai_sts;
                    $kelompoktambah1 = $NilaiBKUKelompoksum1 + $nilai_realisasibulan;
                    $kelompoktambah = $nilai_realisasibulan + $kelompokkurang;
                    $cekidkp = KelompokPenerimaan::where(['id' => $idkp1,])->first();
                    if (!$cekidkp) {
                        $KelompokPenerimaanBaru = new KelompokPenerimaan;
                        $KelompokPenerimaanBaru->id = $idkp1;
                        $KelompokPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $KelompokPenerimaanBaru->id_akun = $request->edit_akun;
                        $KelompokPenerimaanBaru->id_kelompok = $request->edit_kelompok;
                        $KelompokPenerimaanBaru->kode_kelompok = $idBKUKelompok->kode_kelompok;
                        $KelompokPenerimaanBaru->nilai_realisasikelompok = $nilai_realisasibulan;
                        $KelompokPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $KelompokPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $KelompokPenerimaanBaru->save();

                        $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp);
                        $KelompokPenerimaan->nilai_realisasikelompok = $kelompokkurang;
                        $KelompokPenerimaan->save();
                    } elseif ($idkp == $idkp1) {
                        $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp);
                        $KelompokPenerimaan->nilai_realisasikelompok = $kelompoktambah;
                        $KelompokPenerimaan->save();
                    } else {
                        $KelompokPenerimaan1 = KelompokPenerimaan::findOrFail($idkp);
                        $KelompokPenerimaan1->nilai_realisasikelompok = $kelompokkurang;
                        $KelompokPenerimaan1->save();

                        $KelompokPenerimaan = KelompokPenerimaan::findOrFail($idkp1);
                        $KelompokPenerimaan->nilai_realisasikelompok = $kelompoktambah1;
                        $KelompokPenerimaan->save();
                    }

                    $NilaiBKUJenis = JenisPenerimaan::select('jenispenerimaan.nilai_realisasijenis')
                                        ->where('jenispenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(column: ['jenispenerimaan.id_opd' => $request->edit_id_opd1,])
                                        ->where(column: ['jenispenerimaan.id_akun' => $request->edit_BKUAkun1,])
                                        ->where(column: ['jenispenerimaan.id_kelompok' => $request->edit_BKUKelompok1,])
                                        ->where(column: ['jenispenerimaan.kd_jenis' => $request->edit_BKUJenis1,])
                                        ->get();
                    $NilaiBKUJenissum = $NilaiBKUJenis->sum('nilai_realisasijenis');
                    $NilaiBKUJenis1 = JenisPenerimaan::select('jenispenerimaan.nilai_realisasijenis')
                                        ->where('jenispenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(['jenispenerimaan.id_opd' => $request->edit_id_opd,])
                                        ->where(column: ['jenispenerimaan.id_akun' => $request->edit_akun,])
                                        ->where(column: ['jenispenerimaan.id_kelompok' => $request->edit_kelompok,])
                                        ->where(column: ['jenispenerimaan.kd_jenis' => $request->edit_jenis,])
                                        ->get();
                    $NilaiBKUJenissum1 = $NilaiBKUJenis1->sum('nilai_realisasijenis');

                    $idBKUJenis = BKUJenis::where(['id' => $request->edit_jenis,])->first();
                    $jeniskurang = $NilaiBKUJenissum - $BkuPenerimaan22->nilai_sts;
                    $jenistambah1 = $NilaiBKUJenissum1 + $nilai_realisasibulan;
                    $jenistambah = $nilai_realisasibulan + $jeniskurang;
                    $cekidjp = JenisPenerimaan::where(['id' => $idjp1,])->first();
                    if (!$cekidjp) {
                        $JenisPenerimaanBaru = new JenisPenerimaan;
                        $JenisPenerimaanBaru->id = $idjp1;
                        $JenisPenerimaanBaru->id_kp = $idkp1;
                        $JenisPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $JenisPenerimaanBaru->id_akun = $request->edit_akun;
                        $JenisPenerimaanBaru->id_kelompok = $request->edit_kelompok;
                        $JenisPenerimaanBaru->kd_jenis = $request->edit_jenis;
                        $JenisPenerimaanBaru->kode_jenis = $idBKUJenis->kode_jenis;
                        $JenisPenerimaanBaru->nilai_realisasijenis = $nilai_realisasibulan;
                        $JenisPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $JenisPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $JenisPenerimaanBaru->save();

                        $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp);
                        $JenisPenerimaan->nilai_realisasijenis = $jeniskurang;
                        $JenisPenerimaan->save();
                    } elseif ($idjp == $idjp1) {
                        $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp);
                        $JenisPenerimaan->nilai_realisasijenis = $jenistambah;
                        $JenisPenerimaan->save();
                    } else {
                        $JenisPenerimaan1 = JenisPenerimaan::findOrFail($idjp);
                        $JenisPenerimaan1->nilai_realisasijenis = $jeniskurang;
                        $JenisPenerimaan1->save();

                        $JenisPenerimaan = JenisPenerimaan::findOrFail($idjp1);
                        $JenisPenerimaan->nilai_realisasijenis = $jenistambah1;
                        $JenisPenerimaan->save();
                    }

                    $NilaiBKUObjek = ObjekPenerimaan::select('objekpenerimaan.nilai_realisasiobjek')
                                        ->where('objekpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(column: ['objekpenerimaan.id_opd' => $request->edit_id_opd1,])
                                        ->where(column: ['objekpenerimaan.id_akun' => $request->edit_BKUAkun1,])
                                        ->where(column: ['objekpenerimaan.id_kelompok' => $request->edit_BKUKelompok1,])
                                        ->where(column: ['objekpenerimaan.kd_jenis' => $request->edit_BKUJenis1,])
                                        ->where(column: ['objekpenerimaan.kd_objek' => $request->edit_BKUObjek1,])
                                        ->get();
                    $NilaiBKUObjeksum = $NilaiBKUObjek->sum('nilai_realisasiobjek');
                    $NilaiBKUObjek1 = ObjekPenerimaan::select('objekpenerimaan.nilai_realisasiobjek')
                                        ->where('objekpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(['objekpenerimaan.id_opd' => $request->edit_id_opd,])
                                        ->where(column: ['objekpenerimaan.id_akun' => $request->edit_akun,])
                                        ->where(column: ['objekpenerimaan.id_kelompok' => $request->edit_kelompok,])
                                        ->where(column: ['objekpenerimaan.kd_jenis' => $request->edit_jenis,])
                                        ->where(column: ['objekpenerimaan.kd_objek' => $request->edit_objek,])
                                        ->get();
                    $NilaiBKUObjeksum1 = $NilaiBKUObjek1->sum('nilai_realisasiobjek');

                    $idBKUObjek = BKUObjek::where(['id' => $request->edit_Objek,])->first();
                    $objekkurang = $NilaiBKUObjeksum - $BkuPenerimaan22->nilai_sts;
                    $objektambah1 = $NilaiBKUObjeksum1 + $nilai_realisasibulan;
                    $objektambah = $nilai_realisasibulan + $objekkurang;
                    $cekidop = ObjekPenerimaan::where(['id' => $idop1,])->first();
                    if (!$cekidop) {
                        $ObjekPenerimaanBaru = new ObjekPenerimaan;
                        $ObjekPenerimaanBaru->id = $idop1;
                        $ObjekPenerimaanBaru->id_jp = $idjp1;
                        $ObjekPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $ObjekPenerimaanBaru->id_akun = $request->edit_akun;
                        $ObjekPenerimaanBaru->id_kelompok = $request->edit_kelompok;
                        $ObjekPenerimaanBaru->kd_jenis = $request->edit_jenis;
                        $ObjekPenerimaanBaru->kd_objek = $request->edit_Objek;
                        $ObjekPenerimaanBaru->kode_objek = $idBKUObjek->kode_objek;
                        $ObjekPenerimaanBaru->nilai_realisasiobjek = $nilai_realisasibulan;
                        $ObjekPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $ObjekPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $ObjekPenerimaanBaru->save();

                        $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop);
                        $ObjekPenerimaan->nilai_realisasiobjek = $objekkurang;
                        $ObjekPenerimaan->save();
                    } elseif ($idop == $idop1) {
                        $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop);
                        $ObjekPenerimaan->nilai_realisasiobjek = $objektambah;
                        $ObjekPenerimaan->save();
                    } else {
                        $ObjekPenerimaan1 = ObjekPenerimaan::findOrFail($idop);
                        $ObjekPenerimaan1->nilai_realisasiobjek = $objekkurang;
                        $ObjekPenerimaan1->save();

                        $ObjekPenerimaan = ObjekPenerimaan::findOrFail($idop1);
                        $ObjekPenerimaan->nilai_realisasiobjek = $objektambah1;
                        $ObjekPenerimaan->save();
                    }

                    $NilaiBKURinObjek = RincianObjekPenerimaan::select('rincianobjekpenerimaan.nilai_realisasirincian')
                                        ->where('rincianobjekpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(column: ['rincianobjekpenerimaan.id_opd' => $request->edit_id_opd1,])
                                        ->where(column: ['rincianobjekpenerimaan.id_akun' => $request->edit_BKUAkun1,])
                                        ->where(column: ['rincianobjekpenerimaan.id_kelompok' => $request->edit_BKUKelompok1,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_jenis' => $request->edit_BKUJenis1,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_objek' => $request->edit_BKUObjek1,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_rincianobjek' => $request->edit_BKURincianobjek1,])
                                        ->get();
                    $NilaiBKURinObjeksum = $NilaiBKURinObjek->sum('nilai_realisasirincian');
                    $NilaiBKURinObjek1 = RincianObjekPenerimaan::select('rincianobjekpenerimaan.nilai_realisasirincian')
                                        ->where('rincianobjekpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(['rincianobjekpenerimaan.id_opd' => $request->edit_id_opd,])
                                        ->where(column: ['rincianobjekpenerimaan.id_akun' => $request->edit_akun,])
                                        ->where(column: ['rincianobjekpenerimaan.id_kelompok' => $request->edit_kelompok,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_jenis' => $request->edit_jenis,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_objek' => $request->edit_objek,])
                                        ->where(column: ['rincianobjekpenerimaan.kd_rincianobjek' => $request->edit_rincianobjek,])
                                        ->get();
                    $NilaiBKURinObjeksum1 = $NilaiBKURinObjek1->sum('nilai_realisasirincian');

                    $idBKURinObjek = BKURincianobjek::where(['id' => $request->edit_rincianobjek,])->first();
                    $rinobjekkurang = $NilaiBKURinObjeksum - $BkuPenerimaan22->nilai_sts;
                    $rinobjektambah1 = $NilaiBKURinObjeksum1 + $nilai_realisasibulan;
                    $rinobjektambah = $nilai_realisasibulan + $rinobjekkurang;
                    $cekidrop = RincianObjekPenerimaan::where(['id' => $idrop1,])->first();
                    if (!$cekidrop) {
                        $RinObjekPenerimaanBaru = new RincianObjekPenerimaan;
                        $RinObjekPenerimaanBaru->id = $idrop1;
                        $RinObjekPenerimaanBaru->id_op = $idop1;
                        $RinObjekPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $RinObjekPenerimaanBaru->id_akun = $request->edit_akun;
                        $RinObjekPenerimaanBaru->id_kelompok = $request->edit_kelompok;
                        $RinObjekPenerimaanBaru->kd_jenis = $request->edit_jenis;
                        $RinObjekPenerimaanBaru->kd_objek = $request->edit_Objek;
                        $RinObjekPenerimaanBaru->kd_rincianobjek = $request->edit_rincianobjek;
                        $RinObjekPenerimaanBaru->kode_rincianobjek = $idBKURinObjek->kode_rincianobjek;
                        $RinObjekPenerimaanBaru->nilai_realisasirincian = $nilai_realisasibulan;
                        $RinObjekPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $RinObjekPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $RinObjekPenerimaanBaru->save();

                        $RinObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop);
                        $RinObjekPenerimaan->nilai_realisasirincian = $rinobjekkurang;
                        $RinObjekPenerimaan->save();
                    } elseif ($idrop == $idrop1) {
                        $RinObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop);
                        $RinObjekPenerimaan->nilai_realisasirincian = $rinobjektambah;
                        $RinObjekPenerimaan->save();
                    } else {
                        $RinObjekPenerimaan1 = RincianObjekPenerimaan::findOrFail($idrop);
                        $RinObjekPenerimaan1->nilai_realisasirincian = $rinobjekkurang;
                        $RinObjekPenerimaan1->save();

                        $RinObjekPenerimaan = RincianObjekPenerimaan::findOrFail($idrop1);
                        $RinObjekPenerimaan->nilai_realisasirincian = $rinobjektambah1;
                        $RinObjekPenerimaan->save();
                    }

                    $NilaiBKUSRinObjek = OPDPenerimaan::select('opdpenerimaan.nilai_realisasiopd')
                                        ->where('opdpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(column: ['opdpenerimaan.id_opd' => $request->edit_id_opd1,])
                                        ->where(column: ['opdpenerimaan.id_akun' => $request->edit_BKUAkun1,])
                                        ->where(column: ['opdpenerimaan.id_kelompok' => $request->edit_BKUKelompok1,])
                                        ->where(column: ['opdpenerimaan.kd_jenis' => $request->edit_BKUJenis1,])
                                        ->where(column: ['opdpenerimaan.kd_objek' => $request->edit_BKUObjek1,])
                                        ->where(column: ['opdpenerimaan.kd_rincianobjek' => $request->edit_BKURincianobjek1,])
                                        ->where(column: ['opdpenerimaan.kd_subrincianobjek' => $request->edit_Subrincianobjek1,])
                                        ->get();
                    $NilaiBKUSRinObjeksum = $NilaiBKUSRinObjek->sum('nilai_realisasiopd');
                    $NilaiBKUSRinObjek1 = OPDPenerimaan::select('opdpenerimaan.nilai_realisasiopd')
                                        ->where('opdpenerimaan.bulan','like', "%".$request->edit_bulan1."%")
                                        ->where(['opdpenerimaan.id_opd' => $request->edit_id_opd,])
                                        ->where(column: ['opdpenerimaan.id_akun' => $request->edit_akun,])
                                        ->where(column: ['opdpenerimaan.id_kelompok' => $request->edit_kelompok,])
                                        ->where(column: ['opdpenerimaan.kd_jenis' => $request->edit_jenis,])
                                        ->where(column: ['opdpenerimaan.kd_objek' => $request->edit_objek,])
                                        ->where(column: ['opdpenerimaan.kd_rincianobjek' => $request->edit_rincianobjek,])
                                        ->where(column: ['opdpenerimaan.kd_subrincianobjek' => $request->edit_subrincianObjek,])
                                        ->get();
                    $NilaiBKUSRinObjeksum1 = $NilaiBKUSRinObjek1->sum('nilai_realisasiopd');

                    $idBKUSRinObjek = BKUSubrincianobjek::where(['id' => $request->edit_subrincianObjek,])->first();
                    $srinobjekkurang = $NilaiBKUSRinObjeksum - $BkuPenerimaan22->nilai_sts;
                    $srinobjektambah1 = $NilaiBKUSRinObjeksum1 + $nilai_realisasibulan;
                    $srinobjektambah = $nilai_realisasibulan + $srinobjekkurang;
                    $cekidsrop = OPDPenerimaan::where(['id' => $idsrop1,])->first();
                    if (!$cekidsrop) {
                        $SROPenerimaanBaru = new OPDPenerimaan;
                        $SROPenerimaanBaru->id = $idsrop1;
                        $SROPenerimaanBaru->id_rop = $idop1;
                        $SROPenerimaanBaru->id_opd = $request->edit_id_opd;
                        $SROPenerimaanBaru->id_akun = $request->edit_akun;
                        $SROPenerimaanBaru->id_kelompok = $request->edit_kelompok;
                        $SROPenerimaanBaru->kd_jenis = $request->edit_jenis;
                        $SROPenerimaanBaru->kd_objek = $request->edit_Objek;
                        $SROPenerimaanBaru->kd_rincianobjek = $request->edit_rincianobjek;
                        $SROPenerimaanBaru->kd_subrincianobjek = $request->edit_subrincianObjek;
                        $SROPenerimaanBaru->no_rekening = $idBKUSRinObjek->kode_subrincianobjek;
                        $SROPenerimaanBaru->nilai_realisasiopd = $nilai_realisasibulan;
                        $SROPenerimaanBaru->bulan_id = $edit_tanggal_bku3angka;
                        $SROPenerimaanBaru->bulan = $edit_tanggal_bku3;
                        $SROPenerimaanBaru->save();

                        $SROPenerimaan = OPDPenerimaan::findOrFail($idsrop);
                        $SROPenerimaan->nilai_realisasiopd = $srinobjekkurang;
                        $SROPenerimaan->save();
                    } elseif ($idsrop == $idsrop1) {
                        $SROPenerimaan = OPDPenerimaan::findOrFail($idsrop);
                        $SROPenerimaan->nilai_realisasiopd = $srinobjektambah;
                        $SROPenerimaan->save();
                    } else {
                        $SROPenerimaan1 = OPDPenerimaan::findOrFail($idsrop);
                        $SROPenerimaan1->nilai_realisasiopd = $srinobjekkurang;
                        $SROPenerimaan1->save();

                        $SROPenerimaan = OPDPenerimaan::findOrFail($idsrop1);
                        $SROPenerimaan->nilai_realisasiopd = $srinobjektambah1;
                        $SROPenerimaan->save();
                    }

                    $idopd2 = $request->edit_id_opd;
                    $Yes = OPD::find($idopd2);
                    $Yes->aktif_penerimaan = 'Y';
                    $Yes->save();
                    $no_bku = $request->edit_no_bku;
                    $Penerimaan=DB::table("bku")->where('bku.no_bku', $no_bku)
                    ->get();
                    if ($Penerimaan){
                    foreach($Penerimaan as $k)
                    {
                    $saya = $k->id;

                    $BkuPenerimaan = Bku::findOrFail($saya);

                    return view('penerimaan.show',[
                        'BkuPenerimaan' => $BkuPenerimaan,
                    ]);
                    }}
                }

                return redirect()->route('bku-penerimaan.index')->with('success','penerimaan added successfully.');
            }elseif(!$cek){
                $BkuPenerimaan->no_bku = $request->edit_no_bku;
                $BkuPenerimaan->no_rekening = $no_rekening;
                $BkuPenerimaan->tgl_sts = $edit_tgl_sts2;
                $BkuPenerimaan->tanggal_bku = $edit_tanggal_bku2;
                $BkuPenerimaan->uraian_bku = $request->edit_uraian_bku;
                $BkuPenerimaan->id_opd = $request->edit_id_opd;
                $BkuPenerimaan->kd_subrincianobjek = $request->edit_subrincianObjek;
                $BkuPenerimaan->id_bank = $request->edit_id_bank;
                $BkuPenerimaan->nilai_sts = str_replace('.','',$request->edit_nilai_sts);
                $BkuPenerimaan->bulan = $edit_tanggal_bku3;
                $BkuPenerimaan->save();
                if ($request->edit_no_bku) {

                    $no_bku = $request->edit_no_bku;
                    $Penerimaan=DB::table("bku")->where('bku.no_bku', $no_bku)
                    ->get();
                    if ($Penerimaan){
                    foreach($Penerimaan as $k)
                    {
                    $saya = $k->id;

                    $BkuPenerimaan = Bku::findOrFail($saya);

                    return view('penerimaan.show',[
                        'BkuPenerimaan' => $BkuPenerimaan,
                    ]);
                    }}
                }
                return redirect()->route('bku-penerimaan.index')->with('success','penerimaan added successfully.');
            }else{
                return response()->json($validatordouble->errors(), 422);
            }
        }else{
            return response()->json($validator->errors(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id): JsonResponse
    {

        Dana::findOrFail($id)->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function kelompok(Request $request)
    {
    if($request->penerimaan_id){
        $BkuPenerimaan = Bku::find($request->penerimaan_id);
        $KodeRekening = KodeRekening::find(id: $BkuPenerimaan->kd_subrincianobjek);
        $data = BKUKelompok::where("id_akun", $KodeRekening->kd_akun)
        ->get();
        return view('penerimaan.kelompok',[
            'data' => $data,
            'KodeRekening' => $KodeRekening,
        ]);
    }
    elseif($request->kelompok_id) {
        $data['kelompok'] = BKUKelompok::where("id_akun", $request->kelompok_id)
        ->get();
        return response()->json($data);
    }
    }

    public function jenis(Request $request)
    {
        if($request->penerimaan_id){
            $BkuPenerimaan = Bku::find($request->penerimaan_id);
            $KodeRekening = KodeRekening::find(id: $BkuPenerimaan->kd_subrincianobjek);
            $data2 = BKUJenis::where("id_akun", $KodeRekening->kd_akun)
            ->where("kd_kelompok", $KodeRekening->kd_kelompok)
            ->get();
            return view('penerimaan.jenis',[
                'data2' => $data2,
                'KodeRekening' => $KodeRekening,
            ]);
        }
        elseif ($request->jenis_id) {
            # code...
        $id = $request->jenis_id;
        $Kelompok = BKUKelompok::find($id);

        $id_akun = $Kelompok->id_akun;
        $kd_kelompok = $Kelompok->id;

        // $Jenis = BKUJenis::where('jenis.kode_kelompok','like',"%".$request->jenis_id."%")
        // ->get();

        $Jenis['jenis'] = BKUJenis::where("id_akun", $id_akun)
        ->where("kd_kelompok", $kd_kelompok)
        ->get(["kode_jenis","uraian_jenis", "id"]);

        return response()->json($Jenis);
        }
    }

    public function objek(Request $request)
    {
        if($request->penerimaan_id){
            $BkuPenerimaan = Bku::find($request->penerimaan_id);
            $KodeRekening = KodeRekening::find(id: $BkuPenerimaan->kd_subrincianobjek);
            $data3 = BKUObjek::where("id_akun", $KodeRekening->kd_akun)
            ->where("id_kelompok", $KodeRekening->kd_kelompok)
            ->where("kd_jenis", $KodeRekening->kd_jenis)
            ->get();
            return view('penerimaan.objek',[
                'data3' => $data3,
                'KodeRekening' => $KodeRekening,
            ]);
        }
        elseif ($request->Objek_id) {
            $id = $request->Objek_id;
            $jenis = BKUJenis::find($id);
            $id_akun = $jenis->id_akun;
            $id_kelompok = $jenis->id_kelompok;
            $kd_jenis = $jenis->id;

            $data2['objek'] = BKUObjek::where("id_akun", $id_akun)
            ->where("id_kelompok", $id_kelompok)
            ->where("kd_jenis", $kd_jenis)
            ->get(["kode_objek","uraian_objek", "id"]);

            return response()->json($data2);
        }
    }

    public function rincian_objek(Request $request)
    {
        if($request->penerimaan_id){
            $BkuPenerimaan = Bku::find($request->penerimaan_id);
            $KodeRekening = KodeRekening::find(id: $BkuPenerimaan->kd_subrincianobjek);
            $data4 = BKURincianobjek::where("id_akun", $KodeRekening->id_akun)
            ->where("id_kelompok", $KodeRekening->id_kelompok)
            ->where("kd_objek", $KodeRekening->kd_objek)
            ->get();
            return view('penerimaan.rincian-objek',[
                'data4' => $data4,
                'KodeRekening' => $KodeRekening,
            ]);
        }
        elseif ($request->rincian_objek_id) {
            $id = $request->rincian_objek_id;
            $objek = BKUObjek::find($id);
            $id_akun = $objek->id_akun;
            $id_kelompok = $objek->id_kelompok;
            $kd_jenis = $objek->kd_jenis;
            $kd_objek = $objek->id;

            $data3['rincian_objek'] = BKURincianobjek::where("id_akun", $id_akun)
            ->where("id_kelompok", $id_kelompok)
            ->where("kd_objek", $kd_objek)
            ->get(["kode_rincianobjek","uraian_rincianobjek", "id"]);

            return response()->json($data3);
        }
    }

    public function sub_rincian_objek(Request $request)
    {
        if($request->penerimaan_id){
            $BkuPenerimaan = Bku::find($request->penerimaan_id);
            $KodeRekening = KodeRekening::find(id: $BkuPenerimaan->kd_subrincianobjek);
            $data5 = BKUSubrincianobjek::where("id_akun", $KodeRekening->id_akun)
            ->where("id_kelompok", $KodeRekening->id_kelompok)
            ->where("kd_rincianobjek", $KodeRekening->kd_rincianobjek)
            ->get();
            return view('penerimaan.subrincian-objek',[
                'data5' => $data5,
                'KodeRekening' => $KodeRekening,
            ]);
        }
        elseif ($request->sub_rincian_objek_id) {
            $id = $request->sub_rincian_objek_id;
            $rincianobjek = BKURincianobjek::find($id);
            $id_akun = $rincianobjek->id_akun;
            $id_kelompok = $rincianobjek->id_kelompok;
            $kd_jenis = $rincianobjek->kd_jenis;
            $kd_objek = $rincianobjek->kd_objek;
            $kd_rincianobjek = $rincianobjek->id;

            $data4['sub_rincianobjek'] = BKUSubrincianobjek::where("id_akun", $id_akun)
            ->where("id_kelompok", $id_kelompok)
            ->where("kd_rincianobjek", $kd_rincianobjek)
            ->get(["kode_subrincianobjek","uraian_subrincianobjek", "id"]);

            return response()->json($data4);
        }
    }

    public function batal($id)
     {
        $BkuPenerimaan = Bku::find($id);
        return view('penerimaan.batal',[
            'BkuPenerimaan' => $BkuPenerimaan,
        ]);
     }
     public function unbatal($id)
     {
        $BkuPenerimaan = Bku::find($id);
        return view('penerimaan.unbatal',[
            'BkuPenerimaan' => $BkuPenerimaan,
        ]);
     }
     public function update1(Request $request): JsonResponse
     {
         $id = $request->penerimaan_idban;
         $BkuPenerimaan = Bku::findOrFail($id);
         $BkuPenerimaan->aktif = $request->aktif;
         $BkuPenerimaan->save();
         return response()->json(['success' => 'Record deleted successfully.']);
     }
     public function update2(Request $request): JsonResponse
     {
         $id1 = $request->penerimaan_idunban;
         $BkuPenerimaan = Bku::findOrFail($id1);
         $BkuPenerimaan->aktif = $request->aktif;
         $BkuPenerimaan->save();
         return response()->json(['success' => 'Record deleted successfully.']);
     }

}
