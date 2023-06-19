<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $allProducts = Product::where('status',1)->get();
            return response()->json(array('status' => true, 'data' => $allProducts));
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(array('status' => false, 'data' => '','message' => 'Something went wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateRequest = Validator::make($request->all(),[
            'pro_name' => 'required',
            'pro_sku' => 'required',
            'pro_price' => 'required',
        ]);
        if($validateRequest->fails()){

            return response()->json($validateRequest->getMessageBag(), 401);
        }

        if(!empty($request->file('pro_image'))) {
            $imagePath = $request->file('pro_image')->store('public/images');
            $imageName = basename($imagePath);
            $cr_data = [
                'Name' => $request->pro_name,
                'sku' => $request->pro_sku,
                'price' => $request->pro_price,
                'image' => $imageName,
            ];
        }else{
            $cr_data = [
                'Name' => $request->pro_name,
                'sku' => $request->pro_sku,
                'price' => $request->pro_price
            ];
        }
        Product::create($cr_data);

        return response()->json(array('status' => true, 'data' => '', 'message' => 'Product created successfully.'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $product = Product::findOrFail($id);
            return response()->json(array('status' => true, 'data' => $product));
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(array('status' => false, 'data' => '','message' => 'Something went wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateRequest = Validator::make($request->all(),[
            'pro_name' => 'required',
            'pro_sku' => 'required',
            'pro_price' => 'required',
        ]);
        if($validateRequest->fails()){

            return response()->json($validateRequest->getMessageBag(), 401);
        }

        try {
            $product = Product::findOrFail($id);
            if (!empty($request->file('pro_image'))) {
                $imagePath = $request->file('pro_image')->store('public/images');
                $imageName = basename($imagePath);
                $up_data = [
                    'Name' => $request->pro_name,
                    'sku' => $request->pro_sku,
                    'price' => $request->pro_price,
                    'image' => $imageName,
                ];
            } else {
                $up_data = [
                    'Name' => $request->pro_name,
                    'sku' => $request->pro_sku,
                    'price' => $request->pro_price
                ];
            }
            $product->update($up_data);

            return response()->json(array('status' => true, 'data' => '', 'message' => 'Product updated successfully.'), 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(array('status' => false, 'data' => '', 'message' => 'Something went wrong'), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(array('status' => true, 'data' => '', 'message' => 'Product deleted successfully.'), 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(array('status' => false, 'data' => '', 'message' => 'Something went wrong'), 500);
        }
    }
}
