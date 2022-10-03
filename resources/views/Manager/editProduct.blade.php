@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('message'))
    <div class="alert alert-info py-2 rounded" role="alert">
        <h4>{{ Session::get('message') }}</h4>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-3 mb-4">
            <div class="list-group">
                <a href="{{ ( url('/manager') ) }}" class="list-group-item list-group-item-action" aria-current="true">Home</a>
                <a href="{{ ( url('/manager/createProduct') ) }}" class="list-group-item list-group-item-action">新增品項</a>
                <a href="{{ ( url('/manager/editProduct') ) }}" class="list-group-item list-group-item-action active">更改品項內容</a>
                <a href="{{ ( url('/manager/createAdmin') ) }}" class="list-group-item list-group-item-action">新增廚師</a>
            </div>
        </div>
        <div class="col-sm-9">
            <h1>更新品項內容</h1>
            <hr>
            <div class = "row">
                @foreach( $products as $product)
                    <div class="col-sm-3 options form-check">
                        <img src = "<?php echo asset("storage/$product->image")?>" class = "image d-block w-100">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <h4>金額：{{ $product->price }}元</h4>
                        <a class="btn btn-primary" href="{{ url('editInput/'.$product->id) }}" role="button">Edit</a>
                        <a class="btn btn-primary" href="{{ url('delete/'.$product->id) }}" role="button" onclick="return submit_sure()">Delete</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script language="javascript">  
    function submit_sure(){  
        return confirm("確認刪除此產品？");
    }  
</script>  
@endsection