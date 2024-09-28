@extends('layouts.app')

@section('content')
<div class="container">
    <h1>時間割</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>時間</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 6; $i++)
                <tr>
                    <th>{{ $i }}時間目</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection