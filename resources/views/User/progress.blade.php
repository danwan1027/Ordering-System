@extends('layouts.app')
@section('content')
<?php
    $isProgress = false;
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
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/cart') }}" role="tab" aria-controls="messages">購物車</a>
                <a class="list-group-item list-group-item-action active"  data-toggle="list" href="{{ url('/progress') }}" role="tab" aria-controls="messages">餐點進度</a>
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/history') }}" role="tab" aria-controls="messages">歷史紀錄</a>
            </div>
        </div>

        <div class="col-sm-9">
            <h3>餐點進度</h3>
            <div class = "row">
                @foreach($orders as $order)
                    @if($order->customer == auth()->user()->id && ($order-> state == 'making' || $order-> state == 'receiving'))
                        <?php
                            $isProgress = true;
                        ?>
                        <hr>
                        <h4 class = "mt-4">訂單編號：{{ $order->id }}</h4>
                        <h6> 下單時間{{ $order->created_at }} </h6>
                        @foreach($items as $item)
                            @if($item->order_id == $order-> id)
                                <div class="col-sm-3 options">
                                    <img src = "<?php echo asset("storage/$item->image")?>" class = "image d-block w-100">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{{ $item->description }}</p>
                                    <h4>金額：{{ $item->price }}元</h4>
                                </div>
                            @endif
                        @endforeach
                        <div class="border rounded p-3 mb-4 col-sm-8">
                            <h6>備註</h6>
                            <hr>
                            <p>{{ $order->description }}</p>
                            <h4>總金額：{{ $order->price }}元</h4>
                        </div>
                        <div class="col-sm-4 mt-4">
                            <h1 class ="status"><?php echo ($order->state == 'making')?"製作中":"請取餐"?></h1>
                        </div>
                    @endif
                @endforeach
                <?php
                    if($isProgress == false){
                        echo '<hr>';
                        echo '<h2 class = "mt-3" style = "color: gray;" >尚無任何訂單</h2>';
                    }
                ?>
                <!-- @foreach($orders as $order)
                    @if($order -> customer == auth()->user()->id && ($order-> state == 'making' || $order-> state == 'receiving') )
                            <div class="col-sm-3 options">
                                <img src = "<?php echo asset("storage/$order->image")?>" class = "image d-block w-100">
                                <h3>{{ $order->name }}</h3>
                                <p>{{ $order->description }}</p>
                                <h5 class ="status"><?php echo ($order->state == 'making')?"製作中":"請取餐"?></h5>
                            </div>
                    @endif
                @endforeach -->
            </div>
        </div>
    </div>  
</div>
@endsection