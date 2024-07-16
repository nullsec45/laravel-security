<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Todo, User};
use Database\Seeders\{UserSeeder, TodoSeeder};
use Illuminate\Support\Facades\{Auth, Gate};

class PolicyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testPolicy(): void
    {
       $this->seed([UserSeeder::class, TodoSeeder::class]);

       $user=User::where("email","fajar@gmail.com")->firstOrFail();
       Auth::login($user);

       $todo=Todo::first();

       self::assertTrue(Gate::allows("view", $todo));
       self::assertTrue(Gate::allows("update", $todo));
       self::assertTrue(Gate::allows("delete", $todo));
       self::assertTrue(Gate::allows("create", Todo::class));
    }
}
