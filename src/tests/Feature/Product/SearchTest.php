<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Like;
use App\Models\Product;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_「商品名」で部分一致検索ができる()
    {
        $this->seed();

        $response = $this->get('/?keyword=時計');
        $response->assertSee('腕時計');
        $response->assertStatus(200);
    }

    public function test_検索状態がマイリストでも保持されている()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::where('name','腕時計')->first();
        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $response = $this->actingAs($user)->get('/?tab=myList&keyword=時計');
        $response->assertSee('腕時計');
        $response->assertStatus(200);
    }

    public function test_検索状態がマイリストでも保持されているか()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::where('name','腕時計')->first();
        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->actingAs($user)->get('/?keyword=時計');
        $response = $this->actingAs($user)->get('/?tab=myList&keyword=');
        $response->assertSee('腕時計');
        $response->assertStatus(200);
    }
}
