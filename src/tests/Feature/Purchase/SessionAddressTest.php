<?php

namespace Tests\Feature\Purchase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class SessionAddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_送付先住所変更画面にて登録した住所が商品購入画面に反映されている()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $formData = [
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物'
        ];

        $response = $this->actingAs($user)->post("/purchase/sessionAddress/{$product->id}",$formData);
        $response->assertRedirect("/purchase/{$product->id}");

        $response = $this->actingAs($user)->from("/purchase/newAddress/{$product->id}")->withSession($formData)->get("/purchase/{$product->id}");
        $response->assertStatus(200);
        $response->assertSee($formData['post_code'])
                    ->assertSee($formData['address'])
                    ->assertSee($formData['building']);
    }

    public function test_購入した商品に送付先住所が紐づいて登録される()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $formData = [
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物',
            'payment' => 'カード支払い'
        ];

        $this->actingAs($user)->post("/purchase/sessionAddress/{$product->id}",$formData);
        $response = $this->actingAs($user)->withSession($formData)->get("/purchase/success/{$product->id}");
        $this->assertDatabaseHas('orders',[
            'post_code' => '111-1111',
            'address' => 'テスト住所',
            'building' => 'テスト建物'
        ]);
        $response->assertStatus(302);
    }
}
