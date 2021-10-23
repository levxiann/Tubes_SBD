<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category_article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($id)
    {

    }

    public function detail($id)
    {
        $articles = Article::find($id);
        return view("artsandculture.article", compact('articles'));
    }
}
