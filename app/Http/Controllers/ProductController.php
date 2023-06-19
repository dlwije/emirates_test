<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $allProducts = Product::where('status',1)->get();
        return view('product.index', compact('allProducts'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'pro_name' => 'required',
            'pro_sku' => 'required',
            'pro_price' => 'required',
//            'pro_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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

        return redirect()->route('product.list')->with('success', 'Product created successfully.');
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function update(Request $request, $id){
        try {

            $validatedData = $request->validate([
                'pro_name' => 'required',
                'pro_sku' => 'required',
                'pro_price' => 'required',
//            'pro_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

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

            return redirect()->route('product.list')->with('success', 'Product updated successfully.');
        }catch (\Exception $e){
            print_r($e->getMessage());
            Log::error($e);
        }
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
    }
}
