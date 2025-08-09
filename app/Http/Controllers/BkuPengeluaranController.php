<?php

namespace App\Http\Controllers;

use App\Models\Bku;
use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Rekanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BkuPengeluaranController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view BkuPengeluarans', only: ['index']),
            new Middleware('permission:edit BkuPengeluarans', only: ['edit']),
            new Middleware('permission:create BkuPengeluarans', only: ['create']),
            new Middleware('permission:delete BkuPengeluarans', only: ['destroy']),
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
        $rekanan = Rekanan::all();

        $cari_nilai_sp2d = str_replace('.','',$request->cari_nilai_sp2d);
        if ($request->ajax()) {
                $data = Bku::join('dana', 'dana.id', '=' ,'bku.id_dana')
                ->join('opd', 'opd.id', '=' ,'bku.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku.id_bank')
                ->select('bku.*', 'dana.kode_dana', 'opd.uraian_skpd', 'bank.kode_bank')
                ->where('bku.bulan','like',"%".$request->cari_bulan."%")
                ->where('bku.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku.no_bku','like',"%".$request->cari_no_bku."%")
                ->where('bku.no_penguji','like',"%".$request->cari_no_penguji."%")
                ->where('bku.nilai_sp2d','like',"%".$cari_nilai_sp2d."%")
                ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editbaru editPengeluaran"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           if($row->aktif=='N'){
                            $btn.=' <a class="btn btn-sm btn-outline-danger waves-effect waves-light banrecord"  data-id="'.$row->id.'" href="javascript:void(0)"><i class="mdi mdi-close-box mr-2"></i>Batal</a>';
                            }if  ($row->aktif=='Y') {
                                $btn.=' <a class="btn btn-sm btn-outline-warning waves-effect waves-light unbanrecord"  data-id="'.$row->id.'" href="javascript:void(0)"><i class="mdi mdi-close-box mr-2"></i>UnBatal</a>';
                            } return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pengeluaran.list',[
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $opd = Opd::all();
        $bank = Bank::all();
        $dana = Dana::all();
        $rekanan = Rekanan::all();
        return view('pengeluaran.create',[
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
        ]);



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'create_no_bku' => 'required',
            'create_tgl_penguji' => 'required',
            'create_no_penguji' => 'required',
            'create_tanggal_bku' => 'required',
            'create_uraian_bku' => 'required',
            'create_sumber_dana' => 'required',
            'create_nama_opd' => 'required',
            'create_nama_rekanan' => 'required',
            'create_nama_bank' => 'required',
            'create_nilai_sp2d' => 'required',
        ],
        [
            'create_no_bku' => 'Nomer SP2D Masih Kosong',
            'create_tgl_penguji' => 'Tanggal SP2D Masih Kosong',
            'create_no_penguji' => 'Nomer Penguji Masih Kosong',
            'create_tanggal_bku' => 'Tanggal Penguji Masih Kosong',
            'create_uraian_bku' => 'Uraian SP2D Masih Kosong',
            'create_sumber_dana' => 'Sumber Dana Masih Kosong',
            'create_nama_opd' => 'Nama OPD Masih Kosong',
            'create_nama_rekanan' => 'Nama Rekanan Masih Kosong',
            'create_nama_bank' => 'Nama Bank Masih Kosong',
            'create_nilai_sp2d' => 'Nilai SP2D Masih Kosong',
        ]);
        $validatordouble = Validator::make($request->all(), [
            'double_no_bku' => 'required',
         ],
         [
             'double_no_bku' => 'Nomer SP2D Sudah Ada',
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
                    $kd = sprintf("%06s", abs(((int)$k->jumlah)+1)). '/' . $bulanRomawi[$create_tanggal_bku4]. '/' ."PENGELUARAN";
                    $create_tgl_penguji1 = $request->create_tgl_penguji;
                    $create_tgl_penguji2 = Carbon::make($create_tgl_penguji1)->format("Y-m-d");

                    $create_tanggal_bku1 = $request->create_tanggal_bku;
                    $create_tanggal_bku2 = Carbon::make($create_tanggal_bku1)->format("Y-m-d");
                    $create_tanggal_bku3 = Carbon::make($create_tanggal_bku1)->format("F");
                    $create_tanggal_bku44 = Carbon::make($create_tanggal_bku1)->format("m");

                    $Dana = Dana::findOrFail($request->create_sumber_dana);

                    $unit = $request->create_no_bku;
                    $cek = Bku::where(['no_bku' => $unit,])->first();
                    if (!$cek) {
                        $BkuPengeluaran = new Bku;
                        $BkuPengeluaran->kd_bku = $nomor;
                        $BkuPengeluaran->id_bku = $kd;
                        $BkuPengeluaran->no_bku = $request->create_no_bku;
                        $BkuPengeluaran->no_penguji = $request->create_no_penguji;
                        $BkuPengeluaran->tgl_penguji = $create_tgl_penguji2;
                        $BkuPengeluaran->tanggal_bku = $create_tanggal_bku2;
                        $BkuPengeluaran->uraian_bku = $request->create_uraian_bku;
                        $BkuPengeluaran->id_dana = $request->create_sumber_dana;
                        $BkuPengeluaran->uraian_dana = $Dana->uraian_dana;
                        $BkuPengeluaran->id_opd = $request->create_nama_opd;
                        $BkuPengeluaran->nama_rekanan = $request->create_nama_rekanan;
                        $BkuPengeluaran->id_bank = $request->create_nama_bank;
                        $BkuPengeluaran->nilai_sp2d = str_replace('.','',$request->create_nilai_sp2d);
                        $BkuPengeluaran->bulan_id = $create_tanggal_bku44;
                        $BkuPengeluaran->bulan = $create_tanggal_bku3;
                        $BkuPengeluaran->aktif_bku = 'PENGELUARAN';
                        $BkuPengeluaran->save();
                        if ($request->create_no_bku) {
                            $no_bku = $request->create_no_bku;
                            $Pengeluaran=DB::table("bku")->where('bku.no_bku', $no_bku)
                            ->get();


                            if ($Pengeluaran){
                                foreach($Pengeluaran as $k)
                                {
                                    $saya = $k->id;

                                    $BkuPengeluaran = Bku::findOrFail($saya);

                                    return view('pengeluaran.show',[
                                        'BkuPengeluaran' => $BkuPengeluaran,
                                    ]);

                                }
                            }
                        }
                        return redirect()->route('bku-pengeluaran.index')->with('success','Pengeluaran added successfully.');
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

                    $BkuPengeluaran = new Bku;
                    $create_tgl_penguji1 = $request->create_tgl_penguji;
                    $create_tgl_penguji2 = Carbon::make($create_tgl_penguji1)->format("Y-m-d");
                    $Dana = Dana::findOrFail($request->create_sumber_dana);
                    $create_tanggal_bku1 = $request->create_tanggal_bku;
                    $create_tanggal_bku2 = Carbon::make($create_tanggal_bku1)->format("Y-m-d");
                    $create_tanggal_bku3 = Carbon::make($create_tanggal_bku1)->format("F");
                    $create_tanggal_bku4 = Carbon::make($create_tanggal_bku1)->format("n");
                    $create_tanggal_bku5 = Carbon::make($create_tanggal_bku1)->format("m");
                    $num = 1;
                            // $kd = $num."/";
                    $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                    $nomor = sprintf("%06s", $num);
                    $kd = sprintf("%06s", $num). '/' . $bulanRomawi[$create_tanggal_bku4]. '/' ."PENGELUARAN";
                    if($kd){
                        $BkuPengeluaran->kd_bku = $nomor;
                        $BkuPengeluaran->id_bku = $kd;
                        $BkuPengeluaran->no_bku = $request->create_no_bku;
                        $BkuPengeluaran->no_penguji = $request->create_no_penguji;
                        $BkuPengeluaran->tgl_penguji = $create_tgl_penguji2;
                        $BkuPengeluaran->tanggal_bku = $create_tanggal_bku2;
                        $BkuPengeluaran->uraian_bku = $request->create_uraian_bku;
                        $BkuPengeluaran->id_dana = $request->create_sumber_dana;
                        $BkuPengeluaran->uraian_dana = $Dana->uraian_dana;
                        $BkuPengeluaran->id_opd = $request->create_nama_opd;
                        $BkuPengeluaran->nama_rekanan = $request->create_nama_rekanan;
                        $BkuPengeluaran->id_bank = $request->create_nama_bank;
                        $BkuPengeluaran->nilai_sp2d = str_replace('.','',$request->create_nilai_sp2d);
                        $BkuPengeluaran->bulan_id = $create_tanggal_bku5;
                        $BkuPengeluaran->bulan = $create_tanggal_bku3;
                        $BkuPengeluaran->aktif_bku = 'PENGELUARAN';
                        $BkuPengeluaran->save();
                        if ($request->create_no_bku) {
                            $no_bku = $request->create_no_bku;
                            $Pengeluaran=DB::table("bku")->where('bku.no_bku', $no_bku)
                            ->get();
                            if ($Pengeluaran){
                            foreach($Pengeluaran as $k)
                            {
                            $saya = $k->id;

                            $BkuPengeluaran = Bku::findOrFail($saya);

                            return view('pengeluaran.show',[
                                'BkuPengeluaran' => $BkuPengeluaran,
                            ]);
                            }}
                        }
                        return redirect()->route('bku-pengeluaran.index')->with('success','User added successfully.');
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
        $Pengeluaran=DB::table("bku")->where('bku.no_bku', $no_bku)
        ->get();
        if ($Pengeluaran){
        foreach($Pengeluaran as $k)
        {
        $saya = $k->id;

        // $Pengeluaran = BkuPengeluaran::where('id', $no_bku);
        $BkuPengeluaran = Bku::findOrFail($saya);
        // return response()->json($BkuPengeluaran);

        // $no_bku = $request->create_no_bku;
        // $BkuPengeluaran=DB::table("bku")->where('no_bku', $no_bku);

        // return view('pengeluaran.show',[
        //     'BkuPengeluaran' => $BkuPengeluaran,
        // ]);

        // $BkuPengeluaran = BkuPengeluaran::where('id', $no_bku);
        return view('pengeluaran.show',[
            'BkuPengeluaran' => $BkuPengeluaran,
        ]);
        }}
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $BkuPengeluaran = Bku::find($id);
        // return response()->json($BkuPengeluaran);
        $opd = Opd::all();
        $bank = Bank::all();
        $dana = Dana::all();
        $rekanan = Rekanan::all();

        return view('pengeluaran.edit',[

            'BkuPengeluaran' => $BkuPengeluaran,
            'opd' => $opd,
            'bank' => $bank,
            'dana' => $dana,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_pengeluaran_id;

        $BkuPengeluaran = Bku::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_no_bku' => 'required',
            'edit_tgl_penguji' => 'required',
            'edit_no_penguji' => 'required',
            'edit_tanggal_bku' => 'required',
            'edit_uraian_bku' => 'required',
            'edit_id_dana' => 'required',
            'edit_id_opd' => 'required',
            'edit_nama_rekanan' => 'required',
            'edit_id_bank' => 'required',
            'edit_nilai_sp2d' => 'required',
        ],
        [
            'edit_no_bku' => 'Nomer SP2D Masih Kosong',
            'edit_tgl_penguji' => 'Tanggal SP2D Masih Kosong',
            'edit_no_penguji' => 'Nomer Penguji Masih Kosong',
            'edit_tanggal_bku' => 'Tanggal Penguji Masih Kosong',
            'edit_uraian_bku' => 'Uraian SP2D Masih Kosong',
            'edit_id_dana' => 'Sumber Dana Masih Kosong',
            'edit_id_opd' => 'Nama OPD Masih Kosong',
            'edit_nama_rekanan' => 'Nama Rekanan Masih Kosong',
            'edit_id_bank' => 'Nama Bank Masih Kosong',
            'edit_nilai_sp2d' => 'Nilai SP2D Masih Kosong',
        ]);
        $validatordouble = Validator::make($request->all(), [
            'double_no_bku' => 'required',
         ],
         [
             'double_no_bku' => 'Nomer SP2D Sudah Ada',
         ]);
        $edit_tanggal_bku1 = $request->edit_tanggal_bku;
        $edit_tanggal_bku2 = Carbon::make($edit_tanggal_bku1)->format("Y-m-d");
        $edit_tanggal_bku3 = Carbon::make($edit_tanggal_bku1)->format("F");
        $edit_tanggal_bku4 = Carbon::make($edit_tanggal_bku1)->format("m");

        $edit_tgl_penguji1 = $request->edit_tgl_penguji;
        $edit_tgl_penguji2 = Carbon::make($edit_tgl_penguji1)->format("Y-m-d");
        $Dana = Dana::findOrFail($request->edit_id_dana);
        $barusp2d = $request->edit_baru_sp2d;
        $nosp2d = $request->edit_no_bku;
        $unit = $request->edit_no_bku;
        $cek = Bku::where(['no_bku' => $unit,])->first();
        if($validator->passes()){
            if($nosp2d == $barusp2d){
                $BkuPengeluaran->no_bku = $request->edit_no_bku;
                $BkuPengeluaran->tgl_penguji = $edit_tgl_penguji2;
                $BkuPengeluaran->no_penguji = $request->edit_no_penguji;
                $BkuPengeluaran->tanggal_bku = $edit_tanggal_bku2;
                $BkuPengeluaran->uraian_bku = $request->edit_uraian_bku;
                $BkuPengeluaran->id_dana = $request->edit_id_dana;
                $BkuPengeluaran->uraian_dana = $Dana->uraian_dana;
                $BkuPengeluaran->id_opd = $request->edit_id_opd;
                $BkuPengeluaran->nama_rekanan = $request->edit_nama_rekanan;
                $BkuPengeluaran->id_bank = $request->edit_id_bank;
                $BkuPengeluaran->bulan_id = $edit_tanggal_bku4;
                $BkuPengeluaran->bulan = $edit_tanggal_bku3;
                $BkuPengeluaran->nilai_sp2d = str_replace('.','',$request->edit_nilai_sp2d);
                $BkuPengeluaran->save();

                return redirect()->route('bku-pengeluaran.index')->with('success','Pengeluaran added successfully.');
            }elseif(!$cek){
                $BkuPengeluaran->no_bku = $request->edit_no_bku;
                $BkuPengeluaran->tgl_penguji = $edit_tgl_penguji2;
                $BkuPengeluaran->no_penguji = $request->edit_no_penguji;
                $BkuPengeluaran->tanggal_bku = $edit_tanggal_bku2;
                $BkuPengeluaran->uraian_bku = $request->edit_uraian_bku;
                $BkuPengeluaran->id_dana = $request->edit_id_dana;
                $BkuPengeluaran->uraian_dana = $Dana->uraian_dana;
                $BkuPengeluaran->id_opd = $request->edit_id_opd;
                $BkuPengeluaran->nama_rekanan = $request->edit_nama_rekanan;
                $BkuPengeluaran->id_bank = $request->edit_id_bank;
                $BkuPengeluaran->bulan_id = $edit_tanggal_bku4;
                $BkuPengeluaran->bulan = $edit_tanggal_bku3;
                $BkuPengeluaran->nilai_sp2d = str_replace('.','',$request->edit_nilai_sp2d);
                $BkuPengeluaran->save();

                return redirect()->route('bku-pengeluaran.index')->with('success','Pengeluaran added successfully.');
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

     public function batal($id)
     {
        $BkuPengeluaran = Bku::find($id);
        return view('pengeluaran.batal',[
            'BkuPengeluaran' => $BkuPengeluaran,
        ]);
     }
     public function unbatal($id)
     {
        $BkuPengeluaran = Bku::find($id);
        return view('pengeluaran.unbatal',[
            'BkuPengeluaran' => $BkuPengeluaran,
        ]);
     }
     public function update1(Request $request): JsonResponse
     {
         $id = $request->pengeluaran_idban;
         $BkuPengeluaran = Bku::findOrFail($id);
         $BkuPengeluaran->aktif = $request->aktif;
         $BkuPengeluaran->save();
         return response()->json(['success' => 'Record deleted successfully.']);
     }
     public function update2(Request $request): JsonResponse
     {
         $id1 = $request->pengeluaran_idunban;
         $BkuPengeluaran = Bku::findOrFail($id1);
         $BkuPengeluaran->aktif = $request->aktif;
         $BkuPengeluaran->save();
         return response()->json(['success' => 'Record deleted successfully.']);
     }

}
