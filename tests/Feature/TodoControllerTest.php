<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\{UserSeeder, TodoSeeder};
use App\Models\User;


class TodoControllerTest extends TestCase
{
    public function testTodo(){
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $this->post("/api/todo")
            ->assertStatus(403);

        $user=User::where("email","fajar@gmail.com")->firstOrFail();

        $this->actingAs($user)
             ->post("/api/todo")
             ->assertStatus(200);

    }
}
