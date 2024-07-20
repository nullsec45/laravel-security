<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Todo};
use Illuminate\Support\Facades\Auth;
use Database\Seeders\{UserSeeder, TodoSeeder};


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

    public function testView(){
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $user=User::where("email","fajar@gmail.com")->firstOrFail();
        Auth::login($user);

        $todos=Todo::query()->get();

        $this->view("todos", [
            "todos" => $todos
        ])->assertDontSeeText("No Edit")
          ->assertSeeText("Edit")
          ->assertDontSeeText("No Delete")
          ->assertSeeText("Delete");
    }

    public function testViewGuest(){
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $user=User::where("email","fajar@gmail.com")->firstOrFail();

        $todos=Todo::query()->get();

        $this->view("todos", [
            "todos" => $todos
        ])->assertSeeText("No Edit")
          ->assertSeeText("No Delete");
    }
}
