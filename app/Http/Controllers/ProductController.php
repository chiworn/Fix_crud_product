<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allproduct = Product::with('category')->get();
        return response()->json([
            'data' => $allproduct
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Validator::make($request->all(), [
            'name'         => 'required|string',
            'category_id'  => 'required|integer|exists:categories,id',
            'qty'          => 'required|integer|min:0',
            'price'        => 'required|integer|min:0'
        ]);

        if ($product->fails()) {
            return response()->json([
                'success' => false,
                'message' => $product->errors()
            ], 400);
        }

        $pro = Product::create($product->validated());
        $pro->load('category');

        return response()->json([
            'success' => true,
            'message' => 'insert product success',
            'data'    => $pro
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
