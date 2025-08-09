<?php

namespace App\Http\Controllers;

use App\Models\OPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class OPDController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view opds', only: ['index']),
            new Middleware('permission:edit opds', only: ['edit']),
            new Middleware('permission:create opds', only: ['create']),
            new Middleware('permission:delete opds', only: ['destroy']),
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

            $data = OPD::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOPD"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->uraian_skpd.'" data-original-title="Delete" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-delete"></i> Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('opd.list');

        // $opds  = opd::all();
        // return view('opd.list',[
        //     'opds' => $opds,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_uraian_skpd' => 'required',
            'create_singkatan' => 'required|alpha',
        ]);
        $opd = new OPD();
        if($validator->passes()){
            $opd->uraian_skpd = $request->create_uraian_skpd;
            $opd->singkatan = $request->create_singkatan;
            $opd->save();

            Session()->flash('success','OPD create successfully.');
            return redirect()->route('opd.index');
        }else{
            return redirect()->route('opd.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $id): JsonResponse
    {
        $product = OPD::find($id);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $product = OPD::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $product = OPD::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_opd_id;

        $opd = OPD::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_uraian_skpd' => 'required',
            'edit_singkatan' => 'required|alpha',
        ]);

        if($validator->passes()){
            $opd->uraian_skpd = $request->edit_uraian_skpd;
            $opd->singkatan = $request->edit_singkatan;
            $opd->save();

            Session()->flash('success','OPD updated successfully.');
            return redirect()->route('opd.index');
        }else{
            return redirect()->route('opd.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id): JsonResponse
    {

        OPD::findOrFail($id)->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
