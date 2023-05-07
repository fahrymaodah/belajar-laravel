<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\WasteModel;

use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class Waste extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data       = WasteModel::select('*')->leftjoin('category', 'waste.category_id', '=', 'category.category_id')->get();
        $response   = APIFormatter::createApi(200, 'Success', $data);
        return response()->json($response);
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
        try {
            $params = $request->all();

            $validator = Validator::make($params, 
                [
                    'category_id' => 'required',
                    'waste_name' => 'required'
                ],
                [
                    'category_id.required' => 'Category ID is required',
                    'waste_name.required' => 'Waste name is required'
                ]
            );

            if ($validator->fails()) {
                $response = APIFormatter::createApi(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }

            $data = WasteModel::create([
                'category_id' => $params['category_id'],
                'waste_name' => $params['waste_name'],
            ]);

            $response = APIFormatter::createApi(200, 'success', $data);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(400, $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data       = WasteModel::findorfail($id);
            $response   = APIFormatter::createApi(200, 'Success', $data);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
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
        try {
            $params = $request->all();

            $validator = Validator::make($params, 
                [
                    'category_id' => 'required',
                    'waste_name' => 'required'
                ],
                [
                    'category_id.required' => 'Category ID is required',
                    'waste_name.required' => 'Waste name is required'
                ]
            );

            if ($validator->fails()) {
                $response = APIFormatter::createApi(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }
            
            $data = WasteModel::where('waste_id', $id)->first();

            $data->category_id  = $params['category_id'];
            $data->waste_name   = $params['waste_name'];
            $data->save();

            $response = APIFormatter::createApi(200, 'Success', $data);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = WasteModel::findorfail($id);
            $data->delete();

            $response = APIFormatter::createApi(200, 'Success');
            return response()->json($response);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                $response = APIFormatter::createApi(400, 'Cannot delete this data because it is used in another table');
                return response()->json($response);
            }
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }
}
