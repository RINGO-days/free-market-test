<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\UploadedFile;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_必要な情報が取得できる（プロフィール画像、ユーザー名、出品した商品一覧、購入した商品一覧）()
    {
        $this->seed();
        $file = UploadedFile::fake()->create('test.jpg');
        $user = User::factory()->create([
            'image' => $file,
        ]);
        $sellProduct = Product::create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'image' => $file,
            'brand' => 'テストブランド',
            'price' => '1000',
            'number_of_like' => 0,
            'number_of_commnet' => 0,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'status' => 1
        ]);
        $buyProduct = Product::where('name','腕時計')->first();
        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $buyProduct->id,
            'total' => $buyProduct->price,
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物',
            'payment' => 'カード支払い'
        ]);

        $response = $this->actingAs($user)->get('/myList/?page=sell');
        $response->assertSee(asset('storage/'.$user->image))
                ->assertSee($user->name)
                ->assertSee($sellProduct->name)
                ->assertSee($file);
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/myList/?page=buy');
        $response->assertSee($order->product->name);
        $response->assertStatus(200);
    }
}
