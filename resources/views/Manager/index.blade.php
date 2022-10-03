@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3 mb-4">
            <div class="list-group">
                <a href="{{ ( url('/manager') ) }}" class="list-group-item list-group-item-action active" aria-current="true">Home</a>
                <a href="{{ ( url('/manager/createProduct') ) }}" class="list-group-item list-group-item-action">新增品項</a>
                <a href="{{ ( url('/manager/editProduct') ) }}" class="list-group-item list-group-item-action">更改品項內容</a>
                <a href="{{ ( url('/manager/createAdmin') ) }}" class="list-group-item list-group-item-action">新增廚師</a>
            </div>
        </div>
        <div class="col-sm-9">
            <h1>Welcome Home</h1>
            <hr>
            <h3 class = "mt-4">本月營收：{{ $revenue }}元</h3>
        </div>
    </div>
</div>
@endsection