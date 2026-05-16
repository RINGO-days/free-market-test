<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_ログアウトができる()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('logout');

        $response->assertRedirect('/login');
    }
}
