<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category_article;
use App\Models\Medium;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index($id)
    {
        $articles = Medium::findOrFail($id)->category_articles()->get();

        return view("artsandculture.article", compact('articles'));
    }

    public function detail($id, $idmed)
    {
        Category_article::where('article_id', $id)->where('medium_id', $idmed)->firstOrFail(); //cek apakah artikel dan medium sudah sesuai
        $articles = Article::findOrFail($id);
        $mediums = Category_article::where('article_id', $id)->get(); //medium yang ada pada artikel tersebut
        $allmed = Medium::all();

        if(Auth::check())
        {
            $liked = User::find(Auth::user()->id)->favourites()->where('fav_id',3)->where('article_id', $id)->count();
        }
        else
        {
            $liked = -1;
        }

        return view("artsandculture.detailarticle", compact('articles', 'idmed', 'mediums', 'allmed', 'liked'));
    }

    public function create($idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }
        return view("artsandculture.addarticle", compact('idmed'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'credit' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:10240'
        ]);

        $newname = Str::random(20);
        $newname .=".";
        $newname .= $request->file('image')->extension();
        $request->file('image')->move(public_path('images/articles'), $newname);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'credit' => $request->credit,
            'writer' => $request->writer,
            'image' => $newname
        ]);

        $idArticle = Article::orderBy('id', 'DESC')->first();

        Category_article::create([
            'article_id' => $idArticle->id,
            'medium_id' => $id
        ]);

        return redirect('/medium/'. $id)->with('status','Artikel berhasil ditambah');
    }

    public function edit($id, $idmed)
    {
        if(!Auth::check())
        {
            return redirect('/medium');
        }
        elseif(Auth::user()->level == 2)
        {
            return redirect('/medium');
        }
        
        Category_article::where('article_id', $id)->where('medium_id', $idmed)->firstOrFail(); //cek apakah item dan medium sudah sesuai
        $articles = Article::findOrFail($id);
        return view("artsandculture.editarticle", compact('articles', 'idmed'));
    }

    public function update(Request $request, $id, $idmed)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'credit' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        Article::where('id', $id)
        ->update([
            'title' => $request->title,
            'content' => $request->content,
            'credit' => $request->credit,
            'writer' => $request->writer,
        ]);

        if($request->has('image'))
        {
            $newname = Str::random(20);
            $newname .=".";
            $newname .= $request->file('image')->extension();

            $request->file('image')->move(public_path('images/articles'), $newname);

            Article::where('id', $id)
            ->update([
                'image' => $newname
                ]);
        }

        return redirect('/article/'. $id . '/'. $idmed)->with('status','Artikel berhasil diubah');
    }

    public function updatemedium(Request $request, $id)
    {
        $request->validate([
            'articlemed' => 'required'
        ]);

        Category_article::where('article_id', $id)->delete();

        foreach($request->articlemed as $articlemed)
        {
            Category_article::create([
                'article_id' => $id,
                'medium_id' => $articlemed
            ]);
        }

        return redirect('/article/'. $id . '/'. $request->articlemed[0])->with('status','Artikel Medium berhasil diubah');
    }

    public function destroy($id, $idmed)
    {
        Article::destroy($id);

        return redirect('/medium/'.$idmed)->with('status','Artikel berhasil dihapus');
    }

    public function uploadImage(Request $request) 
    {		
        if($request->hasFile('upload')) 
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $request->file('upload')->move(public_path('images/articles/'), $fileName);
       
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('images/articles/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                   
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }	
}
