@extends('layouts.app')
@section('content')
<div class="container">
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
            <h1>編輯品項內容</h1>
            <hr>
            <div class="container">
                <div class ="row">
                    <div class="col-sm-3">
                        <img src="<?php echo asset("storage/$product->image")?>" class = "image d-block w-100" alt="">
                    </div>
                    <div class = "col-sm-9">
                        <form method = "POST" action="/edit/{{ $product->id }}" >
                            {{csrf_field()}}
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">產品名稱</span>
                                <input type="text" class="form-control" name = "name" value = "{{ $product->name }}" aria-label="產品名稱" aria-describedby="basic-addon1">
                            </div>
                            <!-- 選擇套餐或的單點 -->
                            @if( $product->type == 'combo')
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">&nbsp&nbsp&nbsp Type &nbsp&nbsp</label>
                                    <select class="form-select" id="inputGroupSelect01" name = "type">
                                    <option value="combo" selected>Combo</option>
                                    <option value="single">Single</option>
                                    </select>
                                </div>
                            @else
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">&nbsp&nbsp&nbsp Type &nbsp&nbsp</label>
                                    <select class="form-select" id="inputGroupSelect01" name = "type">
                                    <option value="combo">Combo</option>
                                    <option value="single"  selected >Single</option>
                                    </select>
                                </div>
                            @endif
                            <!-- 產品描述 -->
                            @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                            <div class="input-group mb-3">
                                <span class="input-group-text">產品描述</span>
                                <textarea class="form-control" name = "description" aria-label="產品描述" >{{ $product->description }}</textarea>
                            </div>
                            <!-- 金額 -->
                            @if($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">&nbsp&nbsp&nbsp 金額 &nbsp&nbsp&nbsp</span>
                                <input type="number" class="form-control" name = "price" value = "{{ $product->price }}"  placeholder="金額" min="0" max="999">
                            </div>
                            <!-- 按鈕 -->
                            <button class="btn btn-primary col-sm-2" type="submit">變更</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection