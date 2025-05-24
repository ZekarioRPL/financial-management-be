<?php

namespace App\Http\Controllers\Api\Bill;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    public function validator($request)
    {
        $dataRequest = Validator::make($request->all(), [
            'category_id' => 'required',
            'status_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'duedate' => 'required',
            'description' => 'nullable',
        ]);
    
        if ($dataRequest->fails()) {
            response()->json([
                'status' => 422,
                'message' => 'Validasi gagal',
                'errors' => $dataRequest->errors()
            ], 422)->send();
            exit;
        }
    
        return $dataRequest->validated();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $bills = Bill::select('bills.*', 'categories.name as category_name', 'statuses.name as status_name')
                ->leftJoin('categories', 'bills.category_id', '=', 'categories.id')
                ->leftJoin('statuses', 'bills.category_id', '=', 'statuses.id')
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('bills.name', 'like', '%' . $request->name . '%');
                })
                ->get();
                
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat mengambil data kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Data Tagihan berhasil diambil',
            'count' => count($bills),
            'data' => $bills
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestValidated = $this->validator($request);

        DB::beginTransaction();
        try {
            $requestValidated['wallet_id'] = 1;
            $requestValidated['created_by'] = 1;
            $requestValidated['updated_by'] = 0;
            
            Bill::create($requestValidated);

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);            
        }

        return response()->json(self::showMessage(200, 'Success Created Data!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestValidated = $this->validator($request);

        DB::beginTransaction();
        try {
            $requestValidated['wallet_id'] = 1;
            $requestValidated['updated_by'] = 0;
            
            $model = Bill::findOrFail($id);
            $model->update($requestValidated);

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);            
        }

        return response()->json(self::showMessage(200, 'Success Updated Data!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            $model = Bill::findOrFail($id);
            $model->delete();

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);            
        }

        return response()->json(self::showMessage(200, 'Success Deleted Data!'));
    }
}
