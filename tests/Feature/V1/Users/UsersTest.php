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

    public function test_it_must_throw_a_exception_if_we_dont_send_parameters()
    {
        $response = $this->call('POST', 'api/v1/users', []);
        $response->assertStatus(302);        
    }

    public function test_should_update_user_information()
    {
        $response = $this->call('PUT', 'api/v1/users', [
            'id' => '717',
            'full_name' => 'sara',
            'email' => 'sara@gmail.com',
            'mobile' => '0917',
        ]);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
            ]
        ]);
    }

    public function test_it_must_throw_a_exception_if_we_dont_send_parameters_to_update_info()
    {
        $response = $this->call('PUT', 'api/v1/users', []);
        $response->assertStatus(302);
    }
}
