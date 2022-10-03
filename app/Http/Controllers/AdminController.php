<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        $orders = Order::orderBy('created_at', 'desc') -> get();
        $items = DB::table('items')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('Admin/index',[
            'orders' => $orders,
            'items' => $items,
        ]);
    }

    
}
