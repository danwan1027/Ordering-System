<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;

class OrderController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'note' => 'max:15',
        ]);

        if($validator->fails()){
            return redirect('/cart')
                ->withInput()
                ->withErrors($validator);
        }
        
        $items = $_POST['meal'];

        

        //將items加進ordre裡
        $order = new Order;
        $order->name = '1'; // 因為沒有設定nullable()
        if($request->note===NULL){
            $order->description = '無';
        }
        else{
            $order->description = $request->note;
        }
        $order->state = 'making';
        $order->customer = auth()->user()->id;
        for($i = 1 ; $i <= count($items) ; $i++){
            $index = 'item'.$i;

            $order-> $index = $items[$i-1];
        }
        $order->save();

        $totlePrice = 0;

        // 針對每個item作調整
        for($i = 1 ; $i <= 8 ; $i++){
            $index = 'item'.$i;

            $item = Item::find($order-> $index);

            if($order-> $index=== NULL){
                break;
            }
            if($item == NULL){
                break;
            }

            $item->update([
                'order_id'=> $order->id,
                'status'=>'not_in_cart',
            ]);

            // 計算人氣排名
            $product = Product::find($item->product_id);
            $product->update([
                'count' =>  $product->count + 1,
            ]);

            // 計算總金額
            $totlePrice += $item->price;

        }
        

        $order->price = $totlePrice;
        $order->save();
        
        return redirect('/progress')->with('message', '訂單送出成功');
        
        
    }

    // public function update_to_making(){
    //     $ids = $_POST['meal'];
    //     foreach($ids as $id){
    //         $order = Order::find($id);
    //         $order->state = "making";
    //         $order->save();
    //     }
    //     return redirect('/progress')->with('message', '新增成功');
    // }



    public function update_to_receiving($id){

        $order = Order::find($id);
        $order->state = 'receiving';
        $order->save();

        // $orders = Order::orderBy('created_at', 'desc') -> get();
        // return view('Admin/index',[
        //     'orders' => $orders,
        // ]);
        return redirect('/admin')->with('message', '訂單編號：'.$order->id.'變更成功');
    }

    public function update_to_done($id){

        $order = Order::find($id);
        $order->state = 'done';
        $order->save();
        
        // $orders = Order::orderBy('created_at', 'desc') -> get();
        // return view('Admin/index',[
        //     'orders' => $orders,
       // ]);
        return redirect('/admin')->with('message', '訂單編號：'.$order->id.'變更成功');
    }


}
