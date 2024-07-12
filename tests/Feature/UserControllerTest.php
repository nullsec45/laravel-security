<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\UserSeeder;
use App\Models\User;a

class UserControllerTest extends TestCase
{
    public function testCurrent(){
        $this->seed(UserSeeder::class);

        $this->get("/users/current")
             ->assertStatus(302)
             ->assertRedirect("/login");

        $user=User::where("email","fajar@gmail.com")->first();
        $this->actingAs($user)
             ->get("/users/current")
             ->assertSeeText("Hello Rama Fajar");
    }
}
