<?php

namespace App\Http\Controllers;


use App\Models\Bku;
use App\Models\Bulan;
use App\Models\RekapA;
use App\Models\RekapB;
use App\Models\RekapC;
use App\Models\HasilRekapA;
use App\Models\HasilRekapB;
use Illuminate\Http\Request;
use App\Models\SaldoRekKoran;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RekapBKUController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view rekaps', only: ['index']),
            new Middleware('permission:edit rekaps', only: ['edit']),
            new Middleware('permission:create rekaps', only: ['create']),
            new Middleware('permission:delete rekaps', only: ['destroy']),
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

        return view('rekap.list',[
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
        return view('rekap.menu',[
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
            return view('rekap.homerekap',[]);
        }
    }
    public function createsaldo(Request $request)
    {
        $bulan = $request->saldo_id;
        $idbulan = $request->saldo_id;
        $saldokoran = SaldoRekKoran::findOrFail($idbulan);
        return view('rekap.saldokoran',[
            'saldokoran' => $saldokoran,
            'bulan' => $bulan,
        ]);
    }
    public function storesaldo(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_nilai_saldokoran' => 'required',
        ]);

        if($validator->passes()){
            $angka = str_replace('.','',$request->create_nilai_saldokoran);
            $angkanilai = str_replace(',','.',$angka);
            $idbulan = $request->create_saldo_id;
            $nilaisaldo = SaldoRekKoran::findOrFail($idbulan);
            $nilaisaldo->nilai_saldorekkoran = $angkanilai;
            $nilaisaldo->save();
            return redirect()->route('rekap.index')->with('success','User added successfully.');
        }else {
            return response()->json($validator->errors(), 422);
        }
    }
    public function createrincian(Request $request)
    {
        $bulan = $request->cari_bulan;

        $Bkus = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
        ->select('bku.*','opd.uraian_skpd', )
        ->where('bku.aktif_bku','like','PENGELUARAN')
        ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->get();

        $id = $request->rincian_id;
        $rincian = RekapA::findOrFail($id);
        return view('rekap.rincian',[
            'bulan' => $bulan,
            'rincian' => $rincian,

        ]);
    }
    public function storerincian(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_uraian_bkurincian' => 'required',
            'create_nilai_rincian' => 'required',
        ]);

        if($validator->passes()){
            $angka = str_replace('.','',$request->create_nilai_rincian);
            $angkanilai = str_replace(',','.',$angka);
            $bkurincian = new HasilRekapA();
            $bkurincian->id_rekap = $request->create_rincian_id;
            $bkurincian->uraian_rekaprincian = $request->create_uraian_bkurincian;
            $bkurincian->nilai_a = $angkanilai;
            $bkurincian->bulan = $request->create_bulan;
            $bkurincian->save();
            if ($request->create_bulan) {
                $HasilRekap = HasilRekapA::select('hasilrekap_a.nilai_a')
                    ->where('hasilrekap_a.bulan','like', "%".$request->create_bulan."%")
                    ->where('hasilrekap_a.id_rekap','like', "%".$request->create_rincian_id."%")
                    ->get();
                $Bulanupdat=DB::table("tblbulan")
                    ->where('tblbulan.nama_bulan','like', "%".$request->create_bulan."%")
                    ->where('tblbulan.id_rekap','like', "%".$request->create_rincian_id."%")
                    ->get();
                $sumrekap = $HasilRekap->sum('nilai_a');
                if (!$Bulanupdat){
                    $Hasilrekap = new Bulan();
                    $Hasilrekap->id_rekap = $request->create_rincian_id;
                    $Hasilrekap->nama_bulan = $request->create_bulan;
                    $Hasilrekap->nilai_rincian = $sumrekap;
                    $Hasilrekap->save();

                } else {
                        foreach($Bulanupdat as $k)
                            {
                                $UpdateId = $k->id;
                                $HasilrincianUpdate = Bulan::findOrFail($UpdateId);
                                $HasilrincianUpdate->id_rekap = $request->create_rincian_id;
                                $HasilrincianUpdate->nama_bulan = $request->create_bulan;
                                $HasilrincianUpdate->nilai_rincian = $sumrekap;
                                $HasilrincianUpdate->save();
                                return redirect()->route('rekap.index')->with('success','User added successfully.');

                            }
                }
            }
        }else {
            return response()->json($validator->errors(), 422);
        }
    }
    public function createrinciansub(Request $request)
    {
        $bulan = $request->cari_bulan;

        $Bkus = Bku::join('opd', 'opd.id', '=' ,'bku.id_opd')
        ->select('bku.*','opd.uraian_skpd', )
        ->where('bku.aktif_bku','like','PENGELUARAN')
        ->where('bku.bulan','like', "%".$request->cari_bulan."%")
                    ->get();

        $id = $request->rincian_id;
        $rincian = RekapB::findOrFail($id);
        return view('rekap.rinciansub',[
            'bulan' => $bulan,
            'rincian' => $rincian,
            'Bkus' => $Bkus,
        ]);
    }

    public function storerinciansub(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_no_bkurinciansub' => 'required',
            'create_nilai_sp2drincian' => 'required',
            'create_uraian_bkurinciansub' => 'required',
        ]);
        $validatordouble = Validator::make($request->all(), [
            'double_no_bkurincian' => 'required',
         ],
         [
             'double_no_bkurincian' => 'Nomer SP2D Sudah Ada',
         ]);
        $bkurincian = new HasilRekapB();
        if($validator->passes()){
            $unit = $request->create_no_bku;
            $angka = str_replace('.','',$request->create_nilai_sp2drincian);
            $angkanilai = str_replace(',','.',$angka);
            // $angkanilai = number_format($angka,2,'.',',');
            // $cek = HasilRekapB::where(['kode_rekaprincianc' => $unit,])->first();
            // if (!$cek) {
                $bkurincian->id_rekap = $request->create_id_rekap;
                $bkurincian->id_rekaprincian = $request->create_rincian_id;
                $bkurincian->kode_rekaprincianc = $request->create_no_bkurinciansub;
                $bkurincian->uraian_rekaprincianc = $request->create_uraian_bkurinciansub;
                $bkurincian->nilai_sp2d = $angkanilai;
                $bkurincian->bulan = $request->create_bulan;
                $bkurincian->save();

                if ($request->create_bulan) {
                    $HasilRekap = HasilRekapB::select('hasilrekap_b.nilai_sp2d')
                        ->where('hasilrekap_b.bulan','like', "%".$request->create_bulan."%")
                        ->where('hasilrekap_b.id_rekap','like', "%".$request->create_id_rekap."%")
                        ->get();
                    $HasilRekapsub= HasilRekapB::select('hasilrekap_b.nilai_sp2d')
                        ->where('hasilrekap_b.bulan','like', "%".$request->create_bulan."%")
                        ->where('hasilrekap_b.id_rekaprincian','like', "%".$request->create_rincian_id."%")
                        ->get();
                    $Bulanupdat=DB::table("tblbulan")
                        ->where('tblbulan.nama_bulan','like', "%".$request->create_bulan."%")
                        ->where('tblbulan.id_rekap','like', "%".$request->create_id_rekap."%")
                        ->get();
                    $Bulanupdatsub=DB::table("tblbulan")
                        ->where('tblbulan.nama_bulan','like', "%".$request->create_bulan."%")
                        ->where('tblbulan.id_rekaprincian','like', "%".$request->create_rincian_id."%")
                        ->get();
                    $sumrekap = $HasilRekap->sum('nilai_sp2d');
                    $sumrekapsub = $HasilRekapsub->sum('nilai_sp2d');
                    if (!$Bulanupdatsub){
                        $Hasil = new Bulan();
                        $Hasil->id_rekaprincian = $request->create_rincian_id;
                        $Hasil->nama_bulan = $request->create_bulan;
                        $Hasil->nilai_rinciansub = $sumrekapsub;
                        $Hasil->save();
                        if (!$Bulanupdat){
                        $Hasilrekap = new Bulan();
                        $Hasilrekap->id_rekap = $request->create_id_rekap;
                        $Hasilrekap->nama_bulan = $request->create_bulan;
                        $Hasilrekap->nilai_rincian = $sumrekap;
                        $Hasilrekap->save();

                        } else {
                            foreach($Bulanupdat as $k)
                                {
                                    $UpdateId = $k->id;
                                    $HasilrincianUpdate = Bulan::findOrFail($UpdateId);
                                    $HasilrincianUpdate->id_rekap = $request->create_id_rekap;
                                    $HasilrincianUpdate->nama_bulan = $request->create_bulan;
                                    $HasilrincianUpdate->nilai_rincian = $sumrekap;
                                    $HasilrincianUpdate->save();
                                    return redirect()->route('rekap.index')->with('success','User added successfully.');

                                }
                        }
                    } else {
                        foreach($Bulanupdatsub as $k)
                                {
                                    $UpdateId = $k->id;

                                    $HasilrinciansubUpdate = Bulan::findOrFail($UpdateId);
                                    $HasilrinciansubUpdate->id_rekaprincian = $request->create_rincian_id;
                                    $HasilrinciansubUpdate->nama_bulan = $request->create_bulan;
                                    $HasilrinciansubUpdate->nilai_rinciansub = $sumrekapsub;
                                    $HasilrinciansubUpdate->save();



                                }
                                if (!$Bulanupdat){
                                    $Hasilrekap = new Bulan();
                                    $Hasilrekap->id_rekap = $request->create_id_rekap;
                                    $Hasilrekap->nama_bulan = $request->create_bulan;
                                    $Hasilrekap->nilai_rincian = $sumrekap;
                                    $Hasilrekap->save();

                                    } else {
                                        foreach($Bulanupdat as $k)
                                            {
                                                $UpdateId = $k->id;
                                                $HasilrincianUpdate = Bulan::findOrFail($UpdateId);
                                                $HasilrincianUpdate->id_rekap = $request->create_id_rekap;
                                                $HasilrincianUpdate->nama_bulan = $request->create_bulan;
                                                $HasilrincianUpdate->nilai_rincian = $sumrekap;
                                                $HasilrincianUpdate->save();
                                                return redirect()->route('rekap.index')->with('success','User added successfully.');

                                            }
                                    }

                    }
                }
            // }
            // else {
            //     return response()->json($validatordouble->errors(), 422);
            // }
        }else {
            return response()->json($validator->errors(), 422);
        }
    }

    public function deleterincian($id): JsonResponse
    {
        $data1 = HasilRekapA::find($id);
        $bulan = $data1->bulan;
        $id_rekap = $data1->id_rekap;
        $nilaia = $data1->nilai_a;
        $Bulanupdat=DB::table("tblbulan")
            ->where('tblbulan.nama_bulan','like', "%".$bulan."%")
            ->where('tblbulan.id_rekap','like', "%".$id_rekap."%")
            ->get();

        if ($nilaia){

            foreach($Bulanupdat as $k)
            {
            $UpdateId = $k->id;
            $sumrekap = $k->nilai_rincian - $data1->nilai_a;
            $HasilrinciansubUpdate = Bulan::findOrFail($UpdateId);
            $HasilrinciansubUpdate->id_rekap = $id_rekap;
            $HasilrinciansubUpdate->nama_bulan = $bulan;
            $HasilrinciansubUpdate->nilai_rincian = $sumrekap;
            $HasilrinciansubUpdate->save();
            }
            HasilRekapA::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function deleterinciansub($id): JsonResponse
    {
        $data1 = HasilRekapB::find($id);
        $bulan = $data1->bulan;
        $rincian_id = $data1->id_rekaprincian;
        $nilaisp2d = $data1->nilai_sp2d;
        $Bulanupdatsub=DB::table("tblbulan")
            ->where('tblbulan.nama_bulan','like', "%".$bulan."%")
            ->where('tblbulan.id_rekaprincian','like', "%".$rincian_id."%")
            ->get();

        if ($nilaisp2d){

            foreach($Bulanupdatsub as $k)
            {
            $UpdateId = $k->id;
            $sumrekapsub = $k->nilai_rinciansub - $data1->nilai_sp2d;
            $HasilrinciansubUpdate = Bulan::findOrFail($UpdateId);
            $HasilrinciansubUpdate->id_rekaprincian = $rincian_id;
            $HasilrinciansubUpdate->nama_bulan = $bulan;
            $HasilrinciansubUpdate->nilai_rinciansub = $sumrekapsub;
            $HasilrinciansubUpdate->save();
            }
            HasilRekapB::findOrFail($id)->delete();
        }
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
