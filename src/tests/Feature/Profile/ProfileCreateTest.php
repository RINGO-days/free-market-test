<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProfileCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_変更項目が初期値として過去設定されていること（プロフィール画像、ユーザー名、郵便番号、住所）()
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');
        $response->assertSee($user->image)
                ->assertSee($user->name)
                ->assertSee($user->post_code)
                ->assertSee($user->address);
        $response->assertStatus(200);
    }
}
