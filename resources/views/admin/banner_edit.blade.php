@extends('admin.layouts.app')       <!-- 修正 -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                
                    <p>ユーザーネーム：{{ $admin -> name }}</p>
                    <p>メールアドレス：{{ $admin -> email }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
