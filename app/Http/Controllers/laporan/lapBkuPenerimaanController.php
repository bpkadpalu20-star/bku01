<?php

namespace App\Http\Controllers\laporan;

use App\Models\Opd;
use App\Models\Bank;
use App\Models\Dana;
use App\Models\Rekanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BkuPengeluaran;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Controllers\laporan\Controller;

class lapBkuPenerimaanController extends Controller implements HasMiddleware
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
        if ($request->ajax()) {
                $data = BkuPengeluaran::join('dana', 'dana.id', '=' ,'bku_pengeluaran.id_dana')
                ->join('opd', 'opd.id', '=' ,'bku_pengeluaran.id_opd')
                ->join('bank', 'bank.id', '=' ,'bku_pengeluaran.id_bank')
                ->select('bku_pengeluaran.*', 'dana.kode_dana', 'opd.singkatan', 'bank.kode_bank')
                ->where('bku_pengeluaran.bulan','like',"%".$request->cari_bulan."%")
                ->where('bku_pengeluaran.id_opd','like',"%".$request->cari_id_opd."%")
                ->where('bku_pengeluaran.id_bank','like',"%".$request->cari_id_bank."%")
                ->where('bku_pengeluaran.no_sp2d','like',"%".$request->cari_no_sp2d."%")
                ->where('bku_pengeluaran.no_penguji','like',"%".$request->cari_no_penguji."%")
                ->where('bku_pengeluaran.nilai_sp2d','like',"%".$request->cari_nilai_sp2d."%")
                ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPengeluaran"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->uraian_dana.'" data-original-title="Delete" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-delete"></i> Delete</a>';

                            return $btn;
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
        $validator = Validator::make($request->all(),[
            'create_no_sp2d' => 'required',
            'create_tgl_penguji' => 'required',
            'create_no_penguji' => 'required',
            'create_tanggal_sp2d' => 'required',
            'create_uraian_sp2d' => 'required',
            'create_id_dana' => 'required',
            'create_id_opd' => 'required',
            'create_nama_rekanan' => 'required',
            'create_id_bank' => 'required',
            'create_nilai_sp2d' => 'required',
            // 'create_bulan' => 'required',
        ]);
        $nosp2d = $request->create_no_sp2d;
        $Pengeluaransp2d =DB::table("bku_pengeluaran")->where('bku_pengeluaran.no_sp2d', $nosp2d)
        ->get();
        if ($Pengeluaransp2d){
            foreach($Pengeluaransp2d as $sp2d)
            {
                    $saya4 = $sp2d->no_sp2d;
                if ($saya4 > $nosp2d){
                    $create_tanggal_sp2d1 = $request->create_tanggal_sp2d;
                    $create_tanggal_sp2d33 = Carbon::make($create_tanggal_sp2d1)->format("F");
                    $create_tanggal_sp2d4 = Carbon::make($create_tanggal_sp2d1)->format("m");
                    // $data = BkuPengeluaran::select("id_rekanan", DB::raw("COUNT(id_rekanan) as jumlah"))
                    //         ->from("bku_pengeluaran")
                    //         ->where('bulan', $create_tanggal_sp2d33)
                    //         ->orderBy("id_rekanan")
                    //         ->limit(1);
                    $q=DB::table("bku_pengeluaran")->select(DB::raw("COUNT(id_sp2d) as jumlah"))
                            ->where('bulan', $create_tanggal_sp2d33);
                    if ($q->count() >0)
                    {
                        foreach($q->get() as $k)
                        {
                            // $tmp = ((int)$k->jumlah)+1 .'/' .$create_tanggal_sp2d4;
                            // $kd = $tmp.'/'.$create_tanggal_sp2d4 ;

                            // $num = 1;
                            // $kd = $num."/";
                            $create_tanggal_sp2d4 = Carbon::make($create_tanggal_sp2d1)->format("n");
                            $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                            $kd = sprintf("%06s", abs(((int)$k->jumlah)+1)). '/' . $bulanRomawi[$create_tanggal_sp2d4]. '/' ."PENGELUARAN";



                            $create_tgl_penguji1 = $request->create_tgl_penguji;
                            $create_tgl_penguji2 = Carbon::make($create_tgl_penguji1)->format("Y-m-d");

                            $create_tanggal_sp2d1 = $request->create_tanggal_sp2d;
                            $create_tanggal_sp2d2 = Carbon::make($create_tanggal_sp2d1)->format("Y-m-d");
                            $create_tanggal_sp2d3 = Carbon::make($create_tanggal_sp2d1)->format("F");
                            // $nomor = 1;
                            $BkuPengeluaran = new BkuPengeluaran;
                            if($validator->passes())
                            {
                                $BkuPengeluaran->id_sp2d = $kd;
                                $BkuPengeluaran->no_sp2d = $request->create_no_sp2d;
                                $BkuPengeluaran->no_penguji = $request->create_no_penguji;
                                $BkuPengeluaran->tgl_penguji = $create_tgl_penguji2;
                                $BkuPengeluaran->tanggal_sp2d = $create_tanggal_sp2d2;
                                $BkuPengeluaran->uraian_sp2d = $request->create_uraian_sp2d;
                                $BkuPengeluaran->id_dana = $request->create_id_dana;
                                $BkuPengeluaran->id_opd = $request->create_id_opd;
                                $BkuPengeluaran->nama_rekanan = $request->create_nama_rekanan;
                                $BkuPengeluaran->id_bank = $request->create_id_bank;
                                $BkuPengeluaran->nilai_sp2d = str_replace(',','',$request->create_nilai_sp2d);
                                $BkuPengeluaran->bulan = $create_tanggal_sp2d3;
                                $BkuPengeluaran->save();
                                if ($request->create_no_sp2d) {
                                    $no_sp2d = $request->create_no_sp2d;
                                    $Pengeluaran=DB::table("bku_pengeluaran")->where('bku_pengeluaran.no_sp2d', $no_sp2d)
                                    ->get();
                                    if ($Pengeluaran){
                                    foreach($Pengeluaran as $k)
                                    {
                                    $saya = $k->id;

                                    $BkuPengeluaran = BkuPengeluaran::findOrFail($saya);

                                    return view('pengeluaran.show',[
                                        'BkuPengeluaran' => $BkuPengeluaran,
                                    ]);
                                    }}
                                }
                                Session()->flash('success','BKU Pengeluaran create successfully.');
                                return redirect()->route('bku-pengeluaran.index');
                            }else{
                                return redirect()->route('bku-pengeluaran.create')->withInput()->withErrors($validator);

                            }
                        }
                    } else {
                        $BkuPengeluaran = new BkuPengeluaran;

                        $create_tgl_penguji1 = $request->create_tgl_penguji;
                        $create_tgl_penguji2 = Carbon::make($create_tgl_penguji1)->format("Y-m-d");

                        $create_tanggal_sp2d1 = $request->create_tanggal_sp2d;
                        $create_tanggal_sp2d2 = Carbon::make($create_tanggal_sp2d1)->format("Y-m-d");
                        $create_tanggal_sp2d3 = Carbon::make($create_tanggal_sp2d1)->format("F");
                        $create_tanggal_sp2d4 = Carbon::make($create_tanggal_sp2d1)->format("n");

                        $num = 1;
                        // $kd = $num."/";
                        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                        $kd = sprintf("%06s", $num). '/' . $bulanRomawi[$create_tanggal_sp2d4]. '/' ."PENGELUARAN";
                        if($validator->passes()){
                            $BkuPengeluaran->id_sp2d = $kd;
                            $BkuPengeluaran->no_sp2d = $request->create_no_sp2d;
                            $BkuPengeluaran->no_penguji = $request->create_no_penguji;
                            $BkuPengeluaran->tgl_penguji = $create_tgl_penguji2;
                            $BkuPengeluaran->tanggal_sp2d = $create_tanggal_sp2d2;
                            $BkuPengeluaran->uraian_sp2d = $request->create_uraian_sp2d;
                            $BkuPengeluaran->id_dana = $request->create_id_dana;
                            $BkuPengeluaran->id_opd = $request->create_id_opd;
                            $BkuPengeluaran->nama_rekanan = $request->create_nama_rekanan;
                            $BkuPengeluaran->id_bank = $request->create_id_bank;
                            $BkuPengeluaran->nilai_sp2d = str_replace(',','',$request->create_nilai_sp2d);
                            $BkuPengeluaran->bulan = $create_tanggal_sp2d3;
                            $BkuPengeluaran->save();
                            if ($request->create_no_sp2d) {
                                $no_sp2d = $request->create_no_sp2d;
                                $Pengeluaran=DB::table("bku_pengeluaran")->where('bku_pengeluaran.no_sp2d', $no_sp2d)
                                ->get();
                                if ($Pengeluaran){
                                foreach($Pengeluaran as $k){
                                $saya = $k->id;

                                $BkuPengeluaran = BkuPengeluaran::findOrFail($saya);

                                return view('pengeluaran.show',[
                                    'BkuPengeluaran' => $BkuPengeluaran,
                                ]);
                                }}
                            }
                            Session()->flash('success','BKU Pengeluaran create successfully.');
                            return redirect()->route('bku-pengeluaran.index');
                        }else{
                            return redirect()->route('bku-pengeluaran.create')->withInput()->withErrors($validator);

                        }
                    }
                } else {
                    return redirect()->route('bku-pengeluaran.create')->withInput()->withErrors($validator);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request): JsonResponse
    {
        $no_sp2d = $request->create_no_sp2d;
        $BkuPengeluaran = BkuPengeluaran::find($no_sp2d);
        return response()->json($BkuPengeluaran);
    }

    /**
     * Display the specified resource.
     */

     public function show(Request $request)
    {
        $no_sp2d = $request->create_no_sp2d;
        $Pengeluaran=DB::table("bku_pengeluaran")->where('bku_pengeluaran.no_sp2d', $no_sp2d)
        ->get();
        if ($Pengeluaran){
        foreach($Pengeluaran as $k)
        {
        $saya = $k->id;

        // $Pengeluaran = BkuPengeluaran::where('id', $no_sp2d);
        $BkuPengeluaran = BkuPengeluaran::findOrFail($saya);
        // return response()->json($BkuPengeluaran);

        // $no_sp2d = $request->create_no_sp2d;
        // $BkuPengeluaran=DB::table("bku_pengeluaran")->where('no_sp2d', $no_sp2d);

        // return view('pengeluaran.show',[
        //     'BkuPengeluaran' => $BkuPengeluaran,
        // ]);

        // $BkuPengeluaran = BkuPengeluaran::where('id', $no_sp2d);
        return view('pengeluaran.show',[
            'BkuPengeluaran' => $BkuPengeluaran,
        ]);
        }}
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $BkuPengeluaran = BkuPengeluaran::find($id);
        return response()->json($BkuPengeluaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_pengeluaran_id;

        $BkuPengeluaran = BkuPengeluaran::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_no_sp2d' => 'required',
            'edit_tanggal_sp2d' => 'required',
            'edit_uraian_sp2d' => 'required',
            'edit_id_dana' => 'required',
            'edit_id_opd' => 'required',
            'edit_nama_rekanan' => 'required',
            'edit_id_bank' => 'required',
            'edit_nilai_sp2d' => 'required',
        ]);
        $edit_tanggal_sp2d1 = $request->edit_tanggal_sp2d;
        $edit_tanggal_sp2d2 = Carbon::make($edit_tanggal_sp2d1)->format("Y-m-d");
        $edit_tanggal_sp2d3 = Carbon::make($edit_tanggal_sp2d1)->format("F");
        if($validator->passes()){
            $BkuPengeluaran->no_sp2d = $request->edit_no_sp2d;
            $BkuPengeluaran->tanggal_sp2d = $edit_tanggal_sp2d2;
            $BkuPengeluaran->uraian_sp2d = $request->edit_uraian_sp2d;
            $BkuPengeluaran->id_dana = $request->edit_id_dana;
            $BkuPengeluaran->id_opd = $request->edit_id_opd;
            $BkuPengeluaran->nama_rekanan = $request->edit_nama_rekanan;
            $BkuPengeluaran->id_bank = $request->edit_id_bank;
            $BkuPengeluaran->bulan = $edit_tanggal_sp2d3;
            $BkuPengeluaran->nilai_sp2d = str_replace(',','',$request->edit_nilai_sp2d);
            $BkuPengeluaran->save();

            Session()->flash('success','BKU Pengeluaran updated successfully.');
            return redirect()->route('bku-pengeluaran.index');
        }else{
            return redirect()->route('bku-pengeluaran.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id): JsonResponse
    {

        BkuPengeluaran::findOrFail($id)->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
