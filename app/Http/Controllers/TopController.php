<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Article;

class TopController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('display_order')->get();
        $articles = Article::latest()->take(5)->get();
        return view('top', compact('banners', 'articles'));
    }
}