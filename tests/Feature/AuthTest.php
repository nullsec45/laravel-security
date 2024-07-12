<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function testLogin(){
        $this->seed(UserSeeder::class);

        $this->get("/users/login?email=fajar@gmail.com&password=RahasiaBanget")
            ->assertRedirect("/users/current");
        
        $this->get("/users/login?email=wrong&password=wrong") 
             ->assertSeeText("Wrong Credentials");      
    }

    public function testCurrent(){
        $this->seed(UserSeeder::class);

        $this->get("/users/current")
             ->assertSeeText("Hello World");

        $user=User::where("email","fajar@gmail.com")->first();
        $this->actingAs($user)
             ->get("/users/current")
             ->assertSeeText("Hello Rama Fajar");
    }

    public function testTokenGuard(){
        $this->seed([UserSeeder::class]);

        $this->get("/api/users/current", [
            "Accept" => "application/json"
        ])->assertStatus(401);

        $this->get("/api/users/current", [
            "API-Key" => "SecretToken_"
        ])->assertSeeText("Hello Rama Fajar");
    }
}
