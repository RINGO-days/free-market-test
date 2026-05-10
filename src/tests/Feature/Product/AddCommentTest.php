<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class AddCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_ログイン済みのユーザーはコメントを送信できる()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $formData = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'テスト',
        ];

        $response = $this->actingAs($user)->post("/product/comment/{$product->id}",$formData);
        $this->assertDatabaseHas('comments',[
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'テスト',
        ]);
        $this->assertDatabaseHas('products',[
            'number_of_comment' => 1,
        ]);
        $response->assertStatus(302);
    }

    public function test_ログイン前のユーザーはコメントを送信できない()
    {
        $this->seed();
        $product = Product::first();

        $response = $this->post("/product/comment/{$product->id}");
        $response->assertRedirect('/register');
    }

    public function test_コメントが入力されていない場合、バリデーションメッセージが表示される()
    {
        $this->seed();
        $product = Product::first();
        $user = User::factory()->create();
        $formData = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => '',
        ];

        $response = $this->actingAs($user)->post("/product/comment/{$product->id}",$formData);
        $response->assertSessionHasErrors([
            'comment' => 'コメントを入力してください'
        ]);
        $response->assertStatus(302);
    }

    public function test_コメントが255字以上の場合、バリデーションメッセージが表示される()
    {
        $this->seed();
        $product = Product::first();
        $user = User::factory()->create();
        $formData = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => str_repeat('あ',226),
        ];

        $response = $this->actingAs($user)->post("/product/comment/{$product->id}",$formData);
        $response->assertSessionHasErrors([
            'comment' => 'コメントは225文字以内で入力してください'
        ]);
        $response->assertStatus(302);
    }
}
