<?php

namespace Tests\Feature\Purchase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_「購入する」ボタンを押下すると購入が完了する()
    {
        $this->seed();
        $product = Product::first();
        $user = User::factory()->create();
        $formData = [
            'payment' => 'カード支払い',
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物'
        ];

        $response = $this->actingAs($user)->post("/purchase/checkout/{$product->id}",$formData);
        $response->assertStatus(302);
    }

    public function test_購入した商品は商品一覧画面にて「sold」と表示される()
    {
        $this->seed();
        $product = Product::first();
        $user = User::factory()->create();
        $session = [
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物',
            'payment' => 'カード支払い',
        ];

        $this->actingAs($user)->get("/purchase/{$product->id}");
        $response = $this->actingAs($user)->withSession($session)->get("/purchase/success/{$product->id}");
        $response->assertRedirect('/');
        $response = $this->actingAs($user)->get('/');
        $response->assertSee('sold');
    }

    public function test_「プロフィール・購入した商品一覧」に追加されている()
    {
        $this->seed();
        $product = Product::first();
        $user = User::factory()->create();
        $session = [
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物',
            'payment' => 'カード支払い',
        ];

        $this->actingAs($user)->get("/purchase/{$product->id}");
        $response = $this->actingAs($user)->withSession($session)->get("/purchase/success/{$product->id}");
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get("/myList/?page=buy");
        $response->assertSee($product->name);
        $response->assertStatus(200);
    }
}
