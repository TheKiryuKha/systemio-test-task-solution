<?php

declare(strict_types=1);

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PayTest extends WebTestCase
{
    public function testItReturnsCorrectStatusCode(): void
    {
        $data = [
            'product' => 1,
            'couponCode' => 'P25',
            'taxNumber' => 'DE309876543',
            'paymentProcessor' => 'paypal',
        ];

        self::createClient()->jsonRequest('POST', '/purchase', $data);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testValidation(): void
    {
        $data = [
            'product' => 999,
            'couponCode' => 'WRONG',
            'taxNumber' => 'WROIT12345678901NG',
            'paymentProcessor' => 'WRONG',
        ];

        self::createClient()->jsonRequest('POST', '/calculate-price', $data);

        $this->assertResponseStatusCodeSame(422);
    }
}
