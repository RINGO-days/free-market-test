<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;

class ShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_必要な情報が表示される（商品画像、商品名、ブランド名、価格、いいね数、コメント数、商品説明、商品情報（カテゴリ、商品の状態）、コメント数、コメントしたユーザー情報、コメント内容）()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $comment = Comment::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'テスト',
        ]);

        $response = $this->actingAs($user)->get("/show/$product->id");
        $response->assertSee(asset('storage/' . $product->image))
                ->assertSee($product->name)
                ->assertSee($product->brand)
                ->assertSee($product->format_price)
                ->assertSee($product->number_of_like)
                ->assertSee($product->number_of_comment)
                ->assertSee($product->description)
                ->assertSee($product->condition->content)
                ->assertSee($comment->user->name)
                ->assertSee($comment->comment);
        foreach($product->categories as $category){
            $response->assertSee($category->content);
        };
        $response->assertStatus(200);
    }

    public function test_複数選択されたカテゴリが表示されているか()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::with('categories')->where('name','革靴')->first();
        
        $response = $this->actingAs($user)->get("/show/$product->id");
        foreach($product->categories as $category){
            $response->assertSee($category->content);
        };
        $response->assertStatus(200);
    }

}
