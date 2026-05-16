<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;

class AddLikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_いいねアイコンを押下することによって、いいねした商品として登録することができる。()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();

        $this->actingAs($user)->get('/product/show/$prodcut->id');
        $response = $this->actingAs($user)->post("/product/like/$product->id");
        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseHas('products',[
            'number_of_like' => 1,
        ]);
        $response->assertStatus(302);
    }

    public function test_追加済みのアイコンは色が変化する()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();

        $this->actingAs($user)->get('/product/show/$prodcut->id');
        $response = $this->actingAs($user)->post("/product/like/$product->id");
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get("/show/{$product->id}");
        $response->assertSee('ハートロゴ_ピンク.png');
    }

    public function test_再度いいねアイコンを押下することによって、いいねを解除することができる。()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $product->update([
            'number_of_like' => 1
        ]);

        $this->actingAs($user)->get('/product/show/$prodcut->id');
        $response = $this->actingAs($user)->post("/product/like/{$product->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('likes',[
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $response = $this->actingAs($user)->get("/show/{$product->id}");
        $response->assertSee('ハートロゴ_デフォルト.png');
    }
}
