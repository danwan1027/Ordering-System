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
                <a href="{{ ( url('/manager/editProduct') ) }}" class="list-group-item list-group-item-action">更改品項內容</a>
                <a href="{{ ( url('/manager/createAdmin') ) }}" class="list-group-item list-group-item-action active">新增廚師</a>
            </div>
        </div>
        <div class="col-sm-9">
            <h1>新增廚師</h1>
            <hr>
            <div class = "container">
                <form method = "POST" action="/createAdmin" >
                        {{csrf_field()}}
                        <!-- 輸入名字 -->
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                            <input type="text" class="form-control" name = "name" value = "{{ old('name')}}"  placeholder="Name" aria-describedby="basic-addon1">
                        </div>
                        <!-- 輸入信箱 -->
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">&nbsp&nbsp Email-Address &nbsp</span>
                            <input type="text" class="form-control" name = "email" value = "{{ old('email')}}"  placeholder="Email Address" aria-describedby="basic-addon1">
                        </div>
                        <!-- 輸入密碼 -->
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Password &nbsp&nbsp&nbsp&nbsp&nbsp</span>
                            <input type="password" class="form-control" id = "passwordfield" name = "password" placeholder="Password" aria-describedby="basic-addon1">
                            <span class="input-group-text eye" onclick = show_hide_password()>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </span>
                        </div>
                        <!-- 確認密碼 -->
                        @if($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                            <input type="password" class="form-control" id = "password-confirm" name = "confirm_password" placeholder="Confirm Password" aria-describedby="basic-addon1">
                            <span class="input-group-text eye" onclick = show_hide_confirm_password()>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </span>
                        </div>
                        <!-- 送出按鈕 -->
                        <button class="btn btn-primary col-sm-2" type="submit">創建</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection