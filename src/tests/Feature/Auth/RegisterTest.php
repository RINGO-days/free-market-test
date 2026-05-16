<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_名前が入力されていない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください',
            ]);
        $response->assertStatus(302);
    }

    public function test_メールアドレスが入力されていない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => 'テスト太郎',
            'email' => '',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください']);
        $response->assertStatus(302);
    }

    public function test_パスワードが入力されていない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください'
            ]);
        $response->assertStatus(302);
    }

    public function test_パスワードが7文字以下の場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => 'testtes',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasErrors([
            'password' => 'パスワードは8文字以上で入力してください'
            ]);
        $response->assertStatus(302);
    }

    public function test_パスワードが確認用パスワードと一致しない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => 'testtest',
            'password_confirmation' => 'testexample',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasErrors([
            'password' => 'パスワードと一致しません'
            ]);
        $response->assertStatus(302);
    }
    public function test_全ての項目が入力されている場合、会員情報が登録され、プロフィール設定画面に遷移される()
    {
        $response = $this->get('/register');
        $formData = [
            'name' => 'テスト太郎',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post('/register',$formData);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users',[
            'name' => 'テスト太郎',
            'email' => 'test@test.com',
        ]);
        $response->assertRedirect('/email/verify');
    }
}
