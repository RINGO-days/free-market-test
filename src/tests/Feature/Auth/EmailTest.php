<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;

class EmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_会員登録後、認証メールが送信される()
    {
        Notification::fake();

        $response = $this->post(route('register'),[
            'name' => 'テストユーザー',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]);
        $response->assertRedirect('/email/verify');
        $user = User::where('email','test@test.com')->first();
        Notification::assertSentTo($user,VerifyEmail::class);
    }

    public function test_メール認証誘導画面で「認証はこちらから」ボタンを押下するとメール認証サイトに遷移する()
    {
        $this->post(route('register'),[
            'name' => 'テストユーザー',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]);
        $response = $this->get('/email/verify');
        $response->assertSee('http://localhost:8025');
    }

    public function test_メール認証サイトのメール認証を完了すると、プロフィール設定画面に遷移する()
    {
        $user = User::factory()->create();
        $url = URL::SignedRoute(
            'verification.verify',
            [
                'id' => $user->id,
                'hash' => sha1($user->email)
            ]
        );
        $response = $this->actingAs($user)->get($url);
        $response->assertRedirect('/profile');
    }
}
