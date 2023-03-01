<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testHandle_Login()
    {
        $user = User::factory()->create();
        $this->json(
            'POST',
            'api/admin/login',
            [
                'username' => $user->username,
                'password' => '12345678',
            ]
        )
            ->assertJson(['status' => true]);
    }
}
