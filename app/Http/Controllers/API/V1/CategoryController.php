<?php

namespace App\Http\Controllers\API\V1;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        
        return response()->json(['data' => $category], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|unique:categories|max:255'
        ]);

        $category = Category::create([
            'nama' => $request->nama
        ]);

        return response()->json(['msg' => 'Kategori Telah Ditambahkan', 'data' => $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return response()->json(['data' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'nama' => 'required|unique:categories|max:255'
        ]);

        $category->update([ 'nama' => $request->nama ]);

        return response()->json(['msg' => 'Kategori Telah Diperbarui', 'data' => $category], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return response()->json(['msg' => 'Kategori Telah DiHapus', 'data' => $category], 200);
    }
}
