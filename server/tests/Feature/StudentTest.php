<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $user = [
        'nama_lengkap' => 'Muhammad Kafanal Kafi',
        'email' => 'kafi@gmail.com',
        'password' => 'rahasia',
        'confirm_password' => 'rahasia'
    ];

    protected $userToken = null;

    public function test_register()
    {

        $response = $this->json('POST', '/api/auth/register', $this->user);
        $response->assertStatus(201);
    }

    public function test_login()
    {
        $userLogin = [
            'email' => $this->user['email'],
            'password' => $this->user['password']
        ];

        $response = $this->json('POST', '/api/auth/login', $userLogin);
        $response->assertStatus(201);
        $result = json_decode($response->getContent());
        $this->userToken = $result->data->token;
    }
}
