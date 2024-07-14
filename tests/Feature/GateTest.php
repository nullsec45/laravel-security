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
}
