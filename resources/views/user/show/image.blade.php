@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $curriculum->title }}</div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('images/image'.$curriculum->id.'.jpg') }}" class="img-fluid" alt="{{ $curriculum->title }}">
                    </div>
                    
                    <div class="mt-4">
                        <p>{{ $curriculum->description }}</p>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ route('user.delivery') }}" class="btn btn-primary">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection