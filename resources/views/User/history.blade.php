@extends('layouts.app')
@section('content')
<?php
    $isHistory = false;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3 mb-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ url('/') }}" role="tab" aria-controls="home">熱門排行</a>  
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/cart') }}" role="tab" aria-controls="messages">購物車</a>
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="{{ url('/progress') }}" role="tab" aria-controls="messages">餐點進度</a>
                <a class="list-group-item list-group-item-action active"  data-toggle="list" href="{{ url('/history') }}" role="tab" aria-controls="messages">歷史紀錄</a>
            </div>
        </div>

        <div class="col-sm-9">
            <h3>歷史紀錄</h3>
            <div class = "row">
                @foreach($orders as $order)
                    @if($order->customer == auth()->user()->id && $order-> state == 'done' )
                        <?php
                            $isHistory = true;
                        ?>
                        <hr>
                        <h4 class = "mt-4" >訂單編號：{{ $order->id }}</h4>
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
                        <div class="border rounded p-3 mb-3 col-sm-8">
                            <h6>備註</h6>
                            <hr>
                            <p>{{ $order->description }}</p>
                            <h4>總金額：{{ $order->price }}元</h4>
                        </div>
                    @endif
                @endforeach
                <?php
                    if($isHistory == false){
                        echo '<hr>';
                        echo '<h2 class = "mt-3" style = "color: gray;" >尚無任何歷史紀錄</h2>';
                    }
                ?>
                <!-- @foreach($orders as $order)
                    @if($order -> customer == auth()->user()->id && $order-> state === 'done')
                            <div class="col-sm-3 options">
                                <img src = "<?php echo asset("storage/$order->image")?>" class = "image d-block w-100">
                                <h3>{{ $order->name }}</h3>
                                <p>{{ $order->description }}</p>
                            </div>
                    @endif
                @endforeach -->
            </div>
        </div>
    </div>  
</div>
@endsection