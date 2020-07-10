<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $article = Article::with(['user','category'])->get();
        return response()->json(['data' => $article], 200);
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
            'title' => 'required|unique:articles',
            'content' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ]);

        $article = Article::create($request->all());
        return response()->json(['data' => $article],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = Article::where('id', $id)->with(['user','category'])->get();
        return response()->json(['data' => $article],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        $request->validate([
            'title' => 'required|unique:articles',
            'content' => 'required',
        ]);
        $article->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['data' => $article],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();

        return response()->json(['msg' => "Artikel telah dihapus"],200);
    }
}
