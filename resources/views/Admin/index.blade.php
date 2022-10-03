@extends('layouts.app')
@section('content')
<?php
    $isOrder = false;
    $making = 0;
    $receiving =0;
    foreach($orders as $order){
        if($order -> state == 'making'){
            $making++;
        }
        if($order->state == 'receiving'){
            $receiving++;
        }
    }
?>
<div class="container">
    @if(Session::has('message'))
    <div class="alert alert-info py-2 rounded" role="alert">
        <h4>{{ Session::get('message') }}</h4>
    </div>
    @endif
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="row">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <h5>訂單未完成數：<?php echo $making ?></h5>
                    <h5>餐點未取餐數：<?php echo $receiving ?></h5>
                </div>
                <p></p><!-- 換行 -->
                <h3>訂單</h3>
                @foreach($orders as $order)
                    @if($order-> state == 'making' || $order-> state == 'receiving')
                        <?php
                            $isOrder = true;
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
                        <p></p><!-- 換行 -->
                        <div class="border rounded p-3  mb-3 col-sm-8">
                            <h6>備註</h6>
                            <hr>
                            <p>{{ $order->description }}</p>
                            <h4>總金額：{{ $order->price }}元</h4>
                        </div>
                        <p></p><!-- 換行 -->
                        @if( $order->state == 'making')
                            <a class="btn btn-primary col-sm-2 mb-3" href="{{ url('admin/updateToReceiving/'.$order->id) }}" role="button">請取餐</a>
                        @else
                            <a class="btn btn-primary col-sm-2 mb-3" href="{{ url('admin/updateToDone/'.$order->id) }}" role="button">訂單完成</a>
                        @endif 

                    @endif
                @endforeach
                <?php
                    if($isOrder == false){
                        echo '<hr>';
                        echo '<h2 class = "mt-3" style = "color: gray;" >尚無任何訂單</h2>';
                    }
                ?>
                <!-- @foreach($orders as $order)
                    @if( $order->state == 'making' || $order->state == 'receiving')
                        <div class="col-sm-3 options">
                            <img src = "<?php echo asset("storage/$order->image")?>" class = "image d-block w-100">
                            <h3>{{ $order->name }}</h3>
                            <p>{{ $order->description }}</p>
                            @if( $order->state == 'making')
                                <a class="btn btn-primary" href="{{ url('admin/updateToReceiving/'.$order->id) }}" role="button">請取餐</a>
                            @else
                                <a class="btn btn-primary" href="{{ url('admin/updateToDone/'.$order->id) }}" role="button">訂單完成</a>
                            @endif 
                        </div>
                    @endif
                @endforeach -->
            </div>
        </div>
    </div>
</div>
@endsection