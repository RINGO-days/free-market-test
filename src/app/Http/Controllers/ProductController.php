<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
            $products = Product::where('id' , 1)->get();
        }
        else
        {
            $products = Product::all();
        }
        // likesテーブルに変更して
        return view('products.index',compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::KeywordSearch($request->keyword)->get();
        return view('products.index' , compact('products'));
    }

    public function show()
    {
        $product = Product::find(1);
        return view('products.show' , compact('product'));
    }
}
