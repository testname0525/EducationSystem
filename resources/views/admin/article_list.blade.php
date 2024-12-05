@extends('admin.layouts.app')

@section('content')
<!-- 戻るボタン -->
<a href="{{ route('admin.top') }}" class="btn btn-link" style="background: transparent; color: black; border: none;">
        ← 戻る
</a>
<div class="container">
    <h2>お知らせ一覧</h2>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    <a href="{{ route('admin.show.article.create') }}" class="btn btn-primary mb-5 mt-3">新規登録</a>

    <table class="table">
        <thead>
            <tr>
                <th>投稿日時</th>
                <th>タイトル</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->posted_date->format('Y-m-d') }}</td>
                    <td>{{ $article->title }}</td>
                    <td>
                        <a href="{{ route('admin.show.article.edit', $article->id) }}" class="btn btn-warning">変更する</a>
                        <form action="{{ route('admin.delete.article', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $article->id }}">削除する</button>
                            
                            <!-- 削除確認モーダル -->
                            <div class="modal fade" id="deleteModal-{{ $article->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $article->id }}">削除確認</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            本当に削除してもよろしいですか？
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

                                            <form action="{{ route('admin.delete.article', ['id' => $article->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $article->id }}">
                                                <button type="submit" class="btn btn-danger">OK</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
