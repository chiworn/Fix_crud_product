<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcategory = Category::all();
        return response()->json([
            'success' => true,
            'message' => 'select category successfully ..',
            'data'    => $allcategory,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = Validator::make($request->all(),[
            'category_name' => 'required|string',
        ]);

        if($validated->fails()){
            return response()->json([
                'success' => false,
                'message' => $validated->errors()
            ],400);
        }

       $category  =  Category::create($validated->validate());
        return response()->json([
            'success' => true,
            'message' => 'insert Categoru success',
            'data'    => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $searchcate = Category::find($id);
        return response()->json([
            'success' => true,
            'message' => 'search successfully ',
            'data'    => $searchcate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $oldcatecary = Category::find($id);
        $validated  = Validator::make($request->all(),[
            'category_name' => 'required|string',
        ]);

         if($validated->fails()){
            return response()->json([
                'success' => false,
                'message' => $validated->errors()
            ],400);
        }

       
        $oldcatecary->update($validated->validate());
        $newcate = Category::find($id); 
        return response()->json([
            'success' => true,
            'message' => "update successs .. ",
            'data'    => $newcate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cate =  Category::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'delete successfully',
            'data'    => $cate
        ],200);
    }
}
