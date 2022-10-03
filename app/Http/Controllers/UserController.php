<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __contruct(){
        $this->middleware('auth') -> except ('index');
    }

    public function index(){
        // $products = Product::get();
        $products = DB::table('products')
            ->orderBy('count', 'desc')
            ->get();
        return view('User/index',[
            'products' => $products
        ]);
    }

    public function cart(){
        $orders = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->get();
        $items = DB::table('items')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('User/cart',[
            'orders' => $orders,
            'items' => $items,
        ]);
    }

    public function progress(){
        // $order = Order::find(1);
        // echo $order-> id;
        $orders = Order::orderBy('created_at', 'desc') -> get();
        $items = DB::table('items')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('User/progress',[
            'orders' => $orders,
            'items' => $items,
        ]);
    }

    public function history(){
        $orders = Order::orderBy('created_at', 'desc') -> get();
        $items = DB::table('items')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('User/history',[
            'orders' => $orders,
            'items' => $items,
        ]);
    }
}
