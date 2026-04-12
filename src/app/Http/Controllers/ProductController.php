<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('tab') === "recommend")
        {
            $products = Product::all();
        }
        elseif($request->query('tab') === "myList")
        {
            $likes = Like::where('user_id',auth()->id())->pluck('product_id');
            $products = Product::whereIn('id',$likes)->get();
        }
        else
        {
            $products = Product::all();
        }
        return view('products.index',compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::KeywordSearch($request->keyword)->get();
        return view('products.index' , compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('categories','condition','user')->find($id);
        return view('products.show' , compact('product',));
    }

    public function addLike($id)
    {
        $product = Product::find($id);

        $like = Like::where('product_id',$id)->where('user_id',auth()->id())->first();
        if($like){
            Like::destroy($like->id);
            $product->decrement('number_of_like');
        }else{
            Like::create([
                'product_id' => $id,
                'user_id' => auth()->id()
            ]);
            $product->increment('number_of_like');
        }
        return back();
    }

    public function addComment(Request $request,$id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'comment' => $request->comment
        ]);
        return back();
    }
}
