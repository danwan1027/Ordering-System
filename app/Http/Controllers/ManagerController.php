<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index(){
        $orders = DB::table('orders')
            ->get();
        $revenue = 0;
        foreach($orders as $order){
            $revenue += $order->price;
        }
        return view('Manager/index',[
            'revenue' => $revenue,
        ]);
    }

    public function createProduct_page(){
        return view('Manager/createProduct');
    }

    public function createAdmin_page(){
        return view('Manager/createAdmin');
    }

    public function editProduct_page(){
        // $products = Product::orderBy('created_at', 'desc') -> get();
        $products = DB::table('products')
        ->orderBy('count', 'desc')
        ->get();
        return view('Manager/editProduct',[
            'products' => $products,
        ]);
    }

    public function editInput($id){
        $product = Product::find($id);
        return view('Manager/editInput',[
            'product' => $product,
        ]);
    }

    public function createAdmin(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:6',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' =>'required|min:8|same:confirm_password|regex:/[0-9]/',
        ]);

        if($validator->fails()){
            return redirect('/manager/createAdmin')
                ->withInput()
                ->withErrors($validator);
        }

        $user = User::create(['name'=>$request->name, 'role'=>'admin',
            'email'=>$request->email, 'password'=>Hash::make($request->password) ]);

        // return view('Manager/createAdmin');
        return redirect('/manager/createAdmin')->with('message', '新增成功');
    }
    
}
