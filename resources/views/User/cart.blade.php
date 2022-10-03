@extends('layouts.app')
@section('content')
<?php
    $isCart = false;
?>
    <div class="container">
        @if(Session::has('message'))
        <div class="alert alert-info py-2 rounded" role="alert">
            <h4>{{ Session::get('message') }}</h4>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-3 mb-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ url('/') }}" role="tab" aria-controls="home">熱門排行</a>  
                    <a class="list-group-item list-group-item-action active"  data-toggle="list" href="{{ url('/cart') }}" role="tab" aria-controls="messages">購物車</a>
                    <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/progress') }}" role="tab" aria-controls="messages">餐點進度</a>
                    <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/history') }}" role="tab" aria-controls="messages">歷史紀錄</a>
                </div>
            </div>

            <div class="col-sm-9">
                <h3>購物車</h3>
                <hr>
                <form class = 'row' method ="post" action="/createOrder"  onsubmit="return check_cart('meal[]')">
                    {{csrf_field()}}    
                    @foreach($items as $item)
                        @if ($item -> customer == auth()->user()->id && $item-> status === 'cart')
                            <?php
                                $isCart = true;
                            ?>
                            <div class="col-sm-3 options">
                                <img src = "<?php echo asset("storage/$item->image")?>" class = "image d-block w-100">
                                <h3>{{ $item->name }}</h3>
                                <p>{{ $item->description }}</p>
                                <h4>金額：{{ $item->price }}元</h4>
                                <a class="btn btn-primary col-sm-6" href="{{ url('deleteItem/'.$item->id) }}" role="button" >刪除商品</a>
                                <br>
                                <input type="checkbox" name = 'meal[]' value = "{{ $item->id }}" id = "{{ $item->id }}" onclick= "isCheck(<?php echo $item->id ?>, <?php echo $item->price ?> )">
                            </div>
                        @endif
                    @endforeach
                    @if($isCart == true)
                        @if($errors->has('note'))
                            <span class="text-danger">{{ $errors->first('note') }}</span>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">備註</span>
                            <input type="text" name="note"  value="{{ old('note')}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <p></p>
                        <h4 id="totalPrice_cart">總金額：0元</h4>
                        <p></p>

                        <input class="btn btn-primary col-sm-2" type="submit" value="送出訂單">
                    @else 
                        <h2 class = "mt-3" style = "color: gray;" >尚未添加任何商品至購物車</h2>
                    @endif 
                    
                </form>
            </div>
        </div>
    </div>

@endsection