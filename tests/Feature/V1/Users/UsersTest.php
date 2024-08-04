<?php

namespace Tests\Feature\V1\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_should_create_a_new_user(): void
    {
        $response = $this->call('POST', 'api/v1/users', [
            'full_name' => 'erfan',
            'email' => 'erfan@gmail.com',
            'mobile' => '0901',
            'password' => '1234',

        ]);
        $response->assertStatus(201);

        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
                'password'
            ]
        ]);
    }
}
