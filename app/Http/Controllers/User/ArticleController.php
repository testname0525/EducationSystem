<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function showArticleIndex()
    {
        $articles = Article::orderBy('posted_date', 'desc')->get();
        return view('user.top', compact('articles'));
    }

    public function showArticle($id)
    {
        $article = Article::findOrFail($id); // IDに一致する記事を取得

        return view('user.article', compact('article')); // ビューに記事データを渡す
    }

}
