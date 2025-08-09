<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class BankController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view Banks', only: ['index']),
            new Middleware('permission:edit Banks', only: ['edit']),
            new Middleware('permission:create Banks', only: ['create']),
            new Middleware('permission:delete Banks', only: ['destroy']),
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

            $data = Bank::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBank"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-name="'.$row->uraian_bank.'" data-original-title="Delete" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-delete"></i> Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('bank.list');

        // $banks  = Bank::all();
        // return view('Bank.list',[
        //     'Banks' => $banks,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'create_uraian_bank' => 'required',
            'create_kode_bank' => 'required',
            'create_alamat_bank' => 'required',
        ]);
        $bank = new Bank();
        if($validator->passes()){
            $bank->uraian_bank = $request->create_uraian_bank;
            $bank->kode_bank = $request->create_kode_bank;
            $bank->alamat_bank = $request->create_alamat_bank;
            $bank->save();

            Session()->flash('success','Bank create successfully.');
            return redirect()->route('bank.index');
        }else{
            return redirect()->route('bank.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $id): JsonResponse
    {
        $bank = Bank::find($id);
        return response()->json($bank);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $bank = Bank::find($id);
        return response()->json($bank);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): JsonResponse
    {
        $bank = Bank::find($id);
        return response()->json($bank);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->edit_bank_id;

        $bank = Bank::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'edit_uraian_bank' => 'required',
            'edit_kode_bank' => 'required',
            'edit_alamat_bank' => 'required',
        ]);

        if($validator->passes()){
            $bank->uraian_bank = $request->edit_uraian_bank;
            $bank->kode_bank = $request->edit_kode_bank;
            $bank->alamat_bank = $request->edit_alamat_bank;
            $bank->save();

            Session()->flash('success','Bank updated successfully.');
            return redirect()->route('bank.index');
        }else{
            return redirect()->route('bank.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id): JsonResponse
    {

        Bank::findOrFail($id)->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
