<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // お知らせ一覧ページの表示
    public function showArticleList() {
        $articles = Article::all(); // すべてのアーティクルを取得
        return view('admin.article_list', compact('articles'));
    }

    // お知らせ削除処理
    public function deleteArticle($id) {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.show.article.list')->with('success', '記事が削除されました。');
    }

    // お知らせ新規登録ページの表示
    public function showArticleCreate() {
        return view('admin.article_create');
    }

    // お知らせ新規登録処理
    public function showArticleStore(Request $request) {
        $request->validate([
            'posted_date' => 'required|date',
            'title' => 'required|string|max:255',
            'article_contents' => 'required',
        ]);

        // データベースに記事を登録
        Article::create([
            'posted_date' => $request->posted_date,
            'title' => $request->title,
            'article_contents' => $request->article_contents,
        ]);

        // 「登録しました」のアラートを表示
        return redirect()->back()->with('success', '登録しました');
    }

    // お知らせ編集ページの表示
    public function showArticleEdit($id) {
        $article = Article::findOrFail($id);
        return view('admin.article_edit', compact('article'));
    }

    // お知らせ更新処理
    public function updateArticle(Request $request, $id) {
        $request->validate([
            'posted_date' => 'required|date',
            'title' => 'required|string|max:255',
            'article_contents' => 'required',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'posted_date' => $request->posted_date,
            'title' => $request->title,
            'article_contents' => $request->article_contents,
        ]);

        return redirect()->route('admin.show.article.list')->with('success', 'お知らせを更新しました');
    }

}
