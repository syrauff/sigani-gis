<?php

namespace App\Http\Controllers;    
use App\Models\Article;
use Illuminate\Http\Request;
class PortalController extends Controller
{
    public function index() {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        return view('main', ['articles' => $articles]);
    }

    public function allNews() {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();
        return view('all_news', ['articles' => $articles]);
    }

    public function articleView($article) {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        $article = Article::where('slug', $article)->first();
        return view('article_show', ['article' => $article,'articles' => $articles]);
    }
}
