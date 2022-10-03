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
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="{{ url('/') }}" role="tab" aria-controls="home">熱門排行</a>  
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/cart') }}" role="tab" aria-controls="messages">購物車</a>
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/progress') }}" role="tab" aria-controls="messages">餐點進度</a>
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/history') }}" role="tab" aria-controls="messages">歷史紀錄</a>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="row">
                <h3>套餐</h3>
                <hr>
                <form class = "row" method = "post" action= "/addToCart" onsubmit="return submit_sure_index()">
                    {{csrf_field()}}
                    @foreach( $products as $product )
                        @if( $product-> type == 'combo')
                            <div class="col-sm-3 options">
                                <img src = "<?php echo asset("storage/$product->image")?>" class = "image d-block w-100">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <h4>金額：{{ $product->price }}元</h4>
                                <input class="form-check-input" type="radio" name="meal" id="flexRadioDefault1"  value = "{{ $product->id }}">
                            </div>
                        @endif
                    @endforeach
                    <hr>
                    <h3>單點</h3>
                    @foreach( $products as $product )
                        @if( $product-> type == 'single')
                            <div class="col-sm-3 options">
                                <img src = "<?php echo asset("storage/$product->image")?>" class = "image d-block w-100">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <h4>金額：{{ $product->price }}元</h4>
                                <input class="form-check-input" type="radio" name="meal" id="flexRadioDefault1"  value = "{{ $product->id }}">
                            </div>
                        @endif
                    @endforeach
                    <p></p><!-- 換行 -->
                    <input class="btn btn-primary col-sm-2" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>  
</div>
@endsection