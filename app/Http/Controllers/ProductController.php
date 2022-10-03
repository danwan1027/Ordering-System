<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Product;

class ProductController extends Controller
{

    // Create a new Product
    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:7|min:1',
            'description' => 'required|max:20|min:1',
            'image' => 'required| mimes:jpeg,jpg,png',
            'type' => 'required',
            'price' => 'required',
        ],[
            'name.required' => '商品名稱不能空白',
            'description' => '商品描述不能空白',
            'type' => '請選擇',
        ]);

        if($validator->fails()){
            return redirect('/manager/createProduct')
            -> withInput()
            ->withErrors($validator);
        }

        $site_id = request('site_id');
        $imagePath = request('image')->store("upload/{$site_id}", 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(297,297);
        // $image = Image::make(public_path("storage/{$imagePath}"))->resize(900, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        $image->save(public_path("storage/{$imagePath}"), 60);
        $image->save();

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imagePath;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->save();


        return redirect('/manager/createProduct')->with('message', '成功建立新商品');
    }

    public function edit(Request $request, $id){


        $validator = Validator::make($request->all(),[
            'name' => 'required|max:10|min:1',
            'description' => 'required|max:20|min:1',
            'type' => 'required',
            'price' => 'required',
        ],[
            'name.required' => '商品名稱不能空白',
            'description' => '商品描述不能空白',
            'type' => '請選擇',
        ]);

        if($validator->fails()){
            // return redirect('/editInput/{id}')
            // -> withInput()
            // ->withErrors($validator);
            return redirect() -> back() -> withInput()->withErrors($validator);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->save();

        // return redirect('/manager/editProduct');
        return redirect('/manager/editProduct')->with('message', '更新成功');
    }

    public function delete($id){
        
        $product = Product::find($id);
        $product -> delete();

        return redirect('/manager/editProduct')->with('message', '刪除成功');
    }
}
