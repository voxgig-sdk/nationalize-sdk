<?php
declare(strict_types=1);

// Nationalize SDK exists test

require_once __DIR__ . '/../nationalize_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = NationalizeSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
