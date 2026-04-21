<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::KeywordSearch($request->keyword);

        if($request->query('tab') === "myList"){
            $likes = Like::where('user_id',auth()->id())->pluck('product_id');
            $query->whereIn('id',$likes);
        }
        else{
            $myProducts = Product::where('user_id',auth()->id())->pluck('id');
            $query->whereNotIn('id',$myProducts);
        }

        $products = $query->get();

        return view('products.index',compact('products'));
    }

    public function show($item_id)
    {
        $product = Product::with('categories','condition','user')->find($item_id);
        return view('products.show' , compact('product',));
    }

    public function addLike($item_id)
    {
        $product = Product::find($item_id);

        $like = Like::where('product_id',$item_id)->where('user_id',auth()->id())->first();
        if($like){
            Like::destroy($like->id);
            $product->decrement('number_of_like');
        }else{
            Like::create([
                'product_id' => $item_id,
                'user_id' => auth()->id()
            ]);
            $product->increment('number_of_like');
        }
        return back();
    }

    public function addComment(CommentRequest $request,$item_id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $item_id,
            'comment' => $request->comment
        ]);
        $product = Product::find($item_id)->increment('number_of_comment');
        return back();
    }

    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('products.sell',compact('categories','conditions'));
    }

    public function listing(ExhibitionRequest $request)
    {
        $path = $request->file('image')->store('products','public');
        $item = $request->all();
        $item['image'] = $path;
        $item['user_id'] = auth()->id();
        $product = Product::create($item);
        $product->categories()->sync($request->category);

        return redirect('/')->with('success','商品名: ' . $product->name . ' '. '出品をしました');
    }
}
