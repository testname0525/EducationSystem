<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Article;

class TopController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'asc')->get();
        $articles = Article::orderBy('posted_date', 'desc')->take(5)->get();
        return view('user.top', compact('banners', 'articles'));
    }
}