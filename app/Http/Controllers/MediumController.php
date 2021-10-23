<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Article;
use App\Models\Category_article;
use App\Models\Category_item;
use App\Models\Item;

class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediums = Medium::all();
        return view("artsandculture.medium", compact('mediums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mediums = Medium::where('id', $id)->first();
        $count = Category_article::where('medium_id',$id)->count();
        $count_item = Category_item::where('medium_id',$id)->count();
        $articles = Article::select('articles.*')
        ->leftJoin('category_articles', 'articles.id', '=', 'category_articles.article_id')
        ->where('category_articles.medium_id', $id)->paginate(5);
        $items = Item::select('items.*')
        ->leftJoin('category_items', 'items.id', '=', 'category_items.item_id')
        ->where('category_items.medium_id', $id)->paginate(12);
        $media = Medium::where('id','!=',$id)->paginate(5);
        //$others = $media->paginate(5);
        return view("artsandculture.medium_each", compact('mediums','articles','count','count_item','items','media'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
        $count = Category_article::where('medium_id',$id)->count();
        $articles =  Article::select('articles.*')
        ->leftJoin('category_articles', 'articles.id', '=', 'category_articles.article_id')
        ->where('category_articles.medium_id', $id)->get();
        return view("artsandculture.show_all_article", compact('articles','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
