<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    // ./vendor/bin/phpunit とコマンドを打ってテストを実行する。
    use RefreshDatabase;

    protected $user;
    protected $password = 'hello-world';

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['password' => bcrypt($this->password)]);
    }

    public function testLogin(): void
    {
        // 認証リクエスト
        $response = $this->post(route('login'), ['email' => $this->user->email, 'password' => $this->password]);

        // リダイレクト確認
        $response->assertRedirect('/home');

        // 指定したユーザ認証か確認
        $this->assertAuthenticatedAs($this->user);
    }

    public function testLogout(): void
    {
        // 現在の認証済みユーザを指定
        $response = $this->actingAs($this->user);

        // ログアウトリクエスト
        $response->post(route('logout'));

        // ユーザ認証の確認
        $this->assertGuest();
    }
}
