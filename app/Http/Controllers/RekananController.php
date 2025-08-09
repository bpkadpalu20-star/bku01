<?php

namespace App\Http\Controllers;

use App\Models\Rekanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class RekananController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view Rekanans', only: ['index']),
            new Middleware('permission:edit Rekanans', only: ['edit']),
            new Middleware('permission:create Rekanans', only: ['create']),
            new Middleware('permission:delete Rekanans', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        if ($request->ajax()) {

            $data = Rekanan::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editRekanan"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->uraian_rekanan.'" data-original-title="Delete" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-delete"></i> Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('rekanan.list');

        // $rekanans  = Rekanan::all();
        // return view('Rekanan.list',[
        //     'Rekanans' => $rekanans,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_uraian_rekanan' => 'required',
            'create_rekening_rekanan' => 'required|alpha',
        ]);
        $rekanan = new Rekanan();
        if($validator->passes()){
            $rekanan->uraian_rekanan = $request->create_uraian_rekanan;
            $rekanan->rekening_rekanan = $request->create_rekening_rekanan;
            $rekanan->save();

            Session()->flash('success','Rekanan create successfully.');
            return redirect()->route('rekanan.index');
        }else{
            return redirect()->route('rekanan.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $id): JsonResponse
    {
        $rekanan = Rekanan::find($id);
        return response()->json($rekanan);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $rekanan = Rekanan::find($id);
        return response()->json($rekanan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $rekanan = Rekanan::find($id);
        return response()->json($rekanan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_rekanan_id;

        $rekanan = Rekanan::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_uraian_rekanan' => 'required',
            'edit_rekening_rekanan' => 'required|alpha',
        ]);

        if($validator->passes()){
            $rekanan->uraian_rekanan = $request->edit_uraian_rekanan;
            $rekanan->rekening_rekanan = $request->edit_rekening_rekanan;
            $rekanan->save();

            Session()->flash('success','Rekanan updated successfully.');
            return redirect()->route('rekanan.index');
        }else{
            return redirect()->route('rekanan.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id): JsonResponse
    {

        Rekanan::findOrFail($id)->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
