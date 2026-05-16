<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class ListingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_商品出品画面にて必要な情報が保存できること（カテゴリ、商品の状態、商品名、ブランド名、商品の説明、販売価格）()
    {
        $this->seed();
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test.jpg');
        $categoryId = Category::limit(3)->pluck('id')->toArray();
        $formData = [
            'category' => $categoryId,
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
            'image' => $file
        ];
        $response = $this->actingAs($user)->get('/product/sell');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/product/listing',$formData);
        $this->assertDatabaseHas('products',[
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'price' => 1000,
            'description' => 'テスト説明',
            'condition_id' => 1,
        ]);
        $product = Product::where('name','テスト商品')->first();
        foreach($formData['category'] as $category){
            $this->assertDatabaseHas('category_product',[
                'product_id' => $product->id,
                'category_id' => $category
            ]);
        }
        $response->assertStatus(302);
    }
}
