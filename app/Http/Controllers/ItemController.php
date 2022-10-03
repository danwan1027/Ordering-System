<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;

class ItemController extends Controller
{
    public function create(Request $request){
        $product = Product::find($request->meal);

        if($product == null ){
            return redirect('/')->with('message', '尚未選擇商品');
        }

        $item = Item::create([
            'name' => $product -> name,
            'description' => $product->description,
            'status' => 'cart',
            'customer'=> auth()->user()->id,
            'image'=> $product->image,
            'product_id'=> $product->id,
            'price' => $product->price,
        ]);

        return redirect('/')->with('message', '成功加至購物車');
    }

    public function delete($id){
        $item = Item::find($id);
        $item->delete();

        return redirect('/cart')->with('message', '商品刪除成功');
    }
}
