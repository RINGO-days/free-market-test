<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $path = $request->image->store('profiles','public');

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
        if($request->query('tab') === "ListedItem")
        {

        }
        elseif($request->query('tab') === "PurchasedItem")
        {
            $products = Order::with('product')->where('user_id',auth()->id())->get();
        }
        else
        {
            $products = Order::with('product')->get();
        }

        $user = User::find(auth()->id());
        return view('profile.myList',compact('user','products'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.editProfile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->id());
        $user->update($request->all());

        return redirect('/myList');
    }
}
