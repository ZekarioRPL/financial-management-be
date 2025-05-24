<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models as DefaultModel;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:kpi-view', ['only' => ['index', 'show', 'edit', 'createKPI', 'modalAlgorithmGroup']]);
    // }

    public function validator($request)
    {
        $dataRequest = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable'
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
            $categories = Category::select('categories.*')
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->name . '%');
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
            'message' => 'Data kategori berhasil diambil',
            'count' => count($categories),
            'data' => $categories
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
            $requestValidated['table_name'] = DefaultModel::class;
            $requestValidated['created_by'] = 1;
            Category::create($requestValidated);

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
            
            $requestValidated['table_name'] = DefaultModel::class;
            $requestValidated['created_by'] = 1;
            
            $category = Category::findOrFail($id);
            $category->update($requestValidated);

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

            $model = Category::findOrFail($id);
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
