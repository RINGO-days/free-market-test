<?php

namespace Tests\Feature\Purchase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;


class PaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_小計画面で変更が反映される()
    {
        $this->seed();
        $user = User::factory()->create();
        $product = Product::first();
        $formData = [
            'payment' => 'カード支払い',
        ];

        $this->actingAs($user)->get("/purchase/{$product->id}");
        $response = $this->actingAs($user)->get("/purchase/payment/{$product->id}",$formData);
        $followResponse = $this->followRedirects($response);
        $followResponse->assertStatus(200);
        $followResponse->assertSee('カード支払い');
    }
}
