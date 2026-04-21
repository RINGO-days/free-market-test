<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\ProfileRequest;


class ProfileController extends Controller
{
    public function profile()
    {
        return view('auth.profile');
    }

    public function profileCreate(ProfileRequest $request)
    {
        $profile = User::find(auth()->id());
        $path = $request->image;
        if($path){
            $path = $path->store('profiles','public');
        }

        $profile->update([
            'image' => $path,
            'name' => $request->name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building
        ]);
        return redirect('/');
    }

    public function myList(Request $request)
    {
        if($request->query('page') === "buy")
        {
            $products = Order::with('product')->where('user_id',auth()->id())->get()->pluck('product');
        }
        else
        {
            $products = Product::where('user_id',auth()->id())->get();
        }

        $user = auth()->user();
        return view('profile.myList',compact('user','products'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.editProfile',compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = User::find(auth()->id());
        $updateItem = $request->all();
        if($request->image){
            $path = $request->image->store('profiles', 'public');
            $updateItem['image'] = $path;
        }
        $user->update($updateItem);
        return redirect('/myList')->with('success','プロフィールを変更しました');
    }
}
