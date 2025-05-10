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
}
