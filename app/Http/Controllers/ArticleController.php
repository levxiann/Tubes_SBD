<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category_article;
use App\Models\Medium;

class ArticleController extends Controller
{
    public function index($id)
    {
        $articles = Medium::findOrFail($id)->category_articles()->get();

        return view("artsandculture.article", compact('articles'));
    }

    public function detail()
    {
        
    }
}
