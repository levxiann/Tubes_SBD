<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category_article;
use App\Models\Category_item;
use Illuminate\Http\Request;
use App\Models\Medium;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediums = Medium::orderBy('id','DESC')->get();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ]);

        $newname = Str::random(20);
        $newname .=".";
        $newname .= $request->file('image')->extension();

        $request->file('image')->move(public_path('images/mediums'), $newname);

        Medium::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'image' => $newname
        ]);

        return redirect('/medium')->with('status','Medium berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mediums = Medium::findOrFail($id);
        $count_article = Medium::find($id)->category_articles()->count();
        $count_item = Medium::find($id)->category_items()->count();
        $articles = Medium::find($id)->category_articles()->orderBy('article_id', 'DESC')->paginate(5);
        $items = Medium::find($id)->category_items()->orderBy('item_id', 'DESC')->paginate(12);
        $media = Medium::where('id','!=',$id)->paginate(5);
        if(Auth::check())
        {
            $liked = User::find(Auth::user()->id)->favourites()->where('fav_id',1)->where('medium_id', $id)->count();
        }
        else
        {
            $liked = -1;
        }
        return view("artsandculture.medium_each", compact('mediums','articles','items','media', 'count_item', 'count_article', 'liked'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        Medium::where('id', $id)
        ->update([
            'name' => $request->name,
            'desc' => $request->desc
        ]);

        if($request->has('image'))
        {
            $newname = Str::random(20);
            $newname .=".";
            $newname .= $request->file('image')->extension();

            $request->file('image')->move(public_path('images/mediums'), $newname);

            Medium::where('id', $id)
            ->update([
                'image' => $newname
                ]);
        }

        return redirect('/medium/'. $id)->with('status','Medium berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medium::destroy($id);
        
        $items = Item::all();

        foreach ($items as $item) {
            if($item->category_items()->count() == 0)
            {
                Item::destroy($item->id);
            }
        }

        $articles = Article::all();

        foreach ($articles as $article) {
            if($article->category_articles()->count() == 0)
            {
                Article::destroy($article->id);
            }
        }

        return redirect('/medium')->with('status','Medium berhasil dihapus');
    }

    public function search(Request $request)
    {
        if($request->keyword == "")
        {
            $mediums = Medium::orderBy('id', 'DESC')->get();
            return view("artsandculture.medium", compact('mediums'));
        }
        else
        {
            $mediums = Medium::where('name', 'like', "%".$request->keyword."%")->orderBy('id', 'DESC')->get();

            $keyword = $request->keyword;

            $items = Item::where('title','like',"%".$keyword."%")->get();

            $articles = Article::where('title','like',"%".$keyword."%")->get();

            // $articles = Category_article::whereHas('medium', function($q) use($keyword){
            //     $q->where('name','like',"%".$keyword."%");
            // })->orWhereHas('article', function($q) use($keyword){
            //     $q->where('title','like',"%".$keyword."%");
            // })->get();

            return view("artsandculture.search", compact('mediums', 'items', 'articles'));
        }
    }
}
