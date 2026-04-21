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
use Illuminate\Support\Facades\Log;

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
        return redirect("/purchase/{$item_id}")->with('success','お届け先の住所を変更しました');
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
            'metadata' => [
                'item_id' => $product->id],
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
        $post_code = session('post_code');
        $address = session('address');
        $building = session('building');
        $paymentMethod = session('payment');

        $product = Product::find($item_id);
        if($product && $paymentMethod === 'カード支払い'){
            $product->update([
                'status' => 2
            ]);
        }

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

    public function cancel($item_id)
    {
        return redirect("/purchase/{$item_id}")->with('cancel','注文をキャンセルしました');
    }

    public function handleWebhook(Request $request)
    {
    $event = $request->all();

    Log::info('Stripe Webhook届きました: ' . $event['type']);

    switch ($event['type']) {
        case 'checkout.session.completed':
            $session = $event['data']['object'];
            $itemId = $session['metadata']['item_id'];

            $product = Product::find($itemId);

            if ($product) {
                $product->update([
                    'status' => 2,
                ]);
                Log::info('商品ID' . $product->id .':'. $product->name .'を購入済みに更新しました');
            } else {
                Log::error('該当する注文が見つかりませんでした。SessionID: ' . $session[$itemId]);
            }
            break;
    }

    return response()->json(['status' => 'success'], 200);
    }
}
