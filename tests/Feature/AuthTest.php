<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Auth;

class AuthTest extends TestCase
{
    public function testAuth(){
        $this->seed(UserSeeder::class);
        $response=Auth::attempt([
            "email" => "fajar@gmail.com",
            "password" => "RahasiaBanget"
        ], true);

        self::assertTrue($response);

        $user=Auth::user();
        self::assertNotNull($user);
        self::assertEquals("fajar@gmail.com", $user->email);
    }
}
