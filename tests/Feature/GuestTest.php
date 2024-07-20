<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Todo};
use Illuminate\Support\Facades\{Auth, Gate};
use Database\Seeders\{UserSeeder, TodoSeeder};

class GuestTest extends TestCase
{
    public function testRegistrationGuest(){
        self::assertTrue(Gate::allows("create", User::class));
    }

    public function testRegistrationUser(){
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user=User::where("email","fajar@gmail.com")->firstOrFail();
        Auth::login($user);

        self::assertFalse(Gate::allows("create", User::class));
    }
}
