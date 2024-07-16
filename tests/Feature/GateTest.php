<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User,Contact};
use Database\Seeders\{UserSeeder, ContactSeeder};
use Illuminate\Support\Facades\{Auth, Gate};

class GateTest extends TestCase
{
    public function testGate(): void
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);

        $user=User::where("email","fajar@gmail.com")->firstOrFail();
        Auth::login($user);

        $contact=Contact::where("email","zainab@localhost")->firstOrFail();

        self::assertTrue(Gate::allows("get-contact", $contact));
        self::assertTrue(Gate::allows("update-contact", $contact));
        self::assertTrue(Gate::allows("delete-contact", $contact));
    }

    public function testGateMethod(){
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user=User::where("email", "fajar@gmail.com")->first();

        Auth::login($user);

        $contact=Contact::where("email","zainab@localhost")->first();
        self::assertTrue(Gate::any(["get-contact","delete-contact","update-contact"], $contact));
        self::assertFalse(Gate::none(["get-contact","delete-contact","update-contact"], $contact));
    }

    public function testGateNonLogin(){
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user=User::where("email", "fajar@gmail.com")->first();
        $gate=Gate::forUser($user);

        $contact=Contact::where("email", "zainab@localhost")->first();
        self::assertTrue($gate->allows("get-contact", $contact));
        self::assertTrue($gate->allows("update-contact", $contact));
        self::assertTrue($gate->allows("delete-contact", $contact));
    }

    public function testGateResponse(){
        $this->seed([UserSeeder::class, ContactSeeder::class]);
        $user=User::where("email", "fajar@gmail.com")->first();

        Auth::login($user);

        $response=Gate::inspect("delete-contact");
        self::assertFalse($response->allowed());;
    self::assertEquals("You are not admin!", $response->message());
    }
}
