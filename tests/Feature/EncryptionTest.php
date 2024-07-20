<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Crypt;


class EncryptionTest extends TestCase
{
    public function testEncryption(): void
    {
        $value="Rama Fajar Fadhillah";

        $encrypted = Crypt::encryptString($value);
        $decrypted = Crypt::decryptString($encrypted);

        echo $encrypted;
        self::assertEquals($value, $decrypted);
    }
}
