<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $preUrl = url()->previous();
        if(!str_contains($preUrl,'newAddress')){
            session()->forget(['post_code', 'address', 'building']);
        }

        $product = Product::find($item_id);
        $user = auth()->user();
        return view('purchases.purchase',compact('product','user'));
    }

    public function newAddress($item_id)
    {
        $product = Product::find($item_id);

        return view('purchases.address',compact('product'));
    }

    public function sessionAddress(AddressRequest $request,$item_id)
    {
        session([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building
        ]);
        return redirect("/purchase/{$item_id}");
    }

    public function checkout(PurchaseRequest $request,$item_id)
    {
        $product = Product::find($item_id);
        $paymentMethod = $request->payment;

        if($paymentMethod === 'カード支払い'){
            $paymentTypes = ['card'];
            }elseif($paymentMethod === 'コンビニ支払い'){
                $paymentTypes = ['konbini'];
            }


        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session = Session::create([
            'payment_method_types' => $paymentTypes,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url("/purchase/success/{$product->id}"),
            'cancel_url'  => url("/purchase/cancel/{$product->id}"),
        ]);
        session([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
            'payment' => $paymentMethod
        ]);
        return redirect()->away($session->url);

    }

    public function success($item_id)
    {
        $product = Product::find($item_id);
        if($product){
            $product->update([
                'status' => 2
            ]);
        }

        $post_code = session('post_code');
        $address = session('address');
        $building = session('building');
        $paymentMethod = session('payment');

        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'total' => $product->price,
            'post_code' => $post_code,
            'address' => $address,
            'building' => $building,
            'payment' => $paymentMethod
        ]);

        session()->forget(['post_code', 'address', 'building']);

        return redirect('/');
    }
}
