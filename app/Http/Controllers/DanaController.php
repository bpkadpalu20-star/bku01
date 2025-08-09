<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class DanaController extends Controller implements HasMiddleware
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
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        if ($request->ajax()) {

            $data = Dana::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDana"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->uraian_dana.'" data-original-title="Delete" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-delete"></i> Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dana.list');

        // $danas  = dana::all();
        // return view('dana.list',[
        //     'danas' => $danas,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_uraian_dana' => 'required',
            'create_kode_dana' => 'required',
        ]);
        $dana = new Dana();
        if($validator->passes()){
            $dana->uraian_dana = $request->create_uraian_dana;
            $dana->kode_dana = $request->create_kode_dana;
            $dana->save();

            Session()->flash('success','Dana create successfully.');
            return redirect()->route('dana.index');
        }else{
            return redirect()->route('dana.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $id): JsonResponse
    {
        $dana = Dana::find($id);
        return response()->json($dana);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $dana = Dana::find($id);
        return response()->json($dana);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $dana = Dana::find($id);
        return response()->json($dana);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_dana_id;

        $dana = Dana::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_uraian_dana' => 'required',
            'edit_kode_dana' => 'required',
        ]);

        if($validator->passes()){
            $dana->uraian_dana = $request->edit_uraian_dana;
            $dana->kode_dana = $request->edit_kode_dana;
            $dana->save();

            Session()->flash('success','Dana updated successfully.');
            return redirect()->route('dana.index');
        }else{
            return redirect()->route('dana.edit')->withInput()->withErrors($validator);
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
}
