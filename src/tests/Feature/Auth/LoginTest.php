<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    
    public function test_メールアドレスが入力されていない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/login');
        $formData = [
            'email' => '',
            'password' => 'testtest',
        ];

        $response = $this->post('/login',$formData);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください'
        ]);
        $response->assertStatus(302);
    }

    public function test_パスワードが入力されていない場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/login');
        $formData = [
            'email' => 'test@test.com',
            'password' => '',
        ];

        $response = $this->post('/login',$formData);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください'
            ]);
        $response->assertStatus(302);
    }
    public function test_入力情報が間違っている場合、バリデーションメッセージが表示される()
    {
        $response = $this->get('/login');
        $formData = [
            'email' => 'test@test.com',
            'password' => 'testexample',
        ];

        $response = $this->post('/login',$formData);
        $response->assertSessionHasErrors([
            'email' => 'ログイン情報が登録されていません'
            ]);
        $response->assertStatus(302);
    }

    public function test_正しい情報が入力された場合、ログイン処理が実行される()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('testtest'),
        ]);
        $response = $this->get('/login');
        $formData = [
            'email' => 'test@test.com',
            'password' => 'testtest',
        ];
        
        $response = $this->post('/login',$formData);
        $response->assertRedirect('/');
    }
}
