<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class TopController extends Controller
{
    public function index()
    {
        try {
            $banners = Banner::orderBy('created_at', 'desc')->get();
            $articles = Article::orderBy('posted_date', 'desc')->take(5)->get();
        } catch (\Exception $e) {
            Log::error('Error in TopController@index: ' . $e->getMessage());
            $banners = collect();
            $articles = collect();
        }

        return view('user.top.index', compact('banners', 'articles'));
    }
}