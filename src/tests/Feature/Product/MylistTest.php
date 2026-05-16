<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Like;

class MyListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_いいねした商品だけが表示される()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $likeItem = Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=myList');
        $response->assertSee($product->name);
        $response->assertStatus(200);
    }

    public function test_購入済み商品は「sold」と表示される()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $product->update([
            'status' => 2
        ]);

        $response = $this->actingAs($user)->get('/?tab=myList');
        $response->assertSee('sold');
        $response->assertStatus(200);
    }

    public function test_未認証の場合は何も表示されない()
    {
        $response = $this->get('/?tab=myList');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
