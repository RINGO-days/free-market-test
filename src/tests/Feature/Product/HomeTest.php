<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;


class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_全商品を取得できる()
    {
        $this->seed();
        $products = Product::all();

        $response = $this->get('/');
        foreach($products as $product){
            $response->assertSee($product->name);
        }
        $response->assertStatus(200);
    }

    public function test_購入済み商品は「Sold」と表示される()
    {
        $this->seed();
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test.jpg');
        $product = Product::create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'image' => $file,
            'brand' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'status' => 2,
        ]);

        $response = $this->get('/');
        $response->assertSee('sold');
    }

    public function test_自分が出品した商品は表示されない()
    {
        $this->seed();
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test.jpg');
        $product = Product::create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'image' => $file,
            'brand' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'status' => 1,
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertDontSee($product->name);
    }
}
