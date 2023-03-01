<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;

class RegisterTest extends TestCase
{
        public function testHandle_Register()
    {
        $faker = app(Faker::class);
          $this->json(
            'POST',
            'api/admin/register',
            [
                'username' => $faker->username,
                'name' => $faker->name,
                'phone' => '0835357550',
                'email' => $faker->email,
                'password' => '12345678',
                'Confirm_password' => '12345678'
            ]
        )->assertJson(['status' => true]);
    }
}
