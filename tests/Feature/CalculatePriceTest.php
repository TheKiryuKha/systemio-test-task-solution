<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CalculatePriceTest extends WebTestCase
{
    public function testItReturnsCorrectStatusCode(): void
    {
        $data = [
            'product' => 1,
            'couponCode' => 'P25',
            'taxNumber' => 'DE309876543',
        ];

        self::createClient()->jsonRequest('POST', '/calculate-price', $data);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testItCalculatesPriceWithDiscountCoupon(): void
    {
        $client = self::createClient();
        $data = [
            'product' => 1,
            'couponCode' => 'P25',
            'taxNumber' => 'DE309876543',
        ];

        $client->jsonRequest('POST', '/calculate-price', $data);

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(89.25, $responseData['totalPrice']);
    }

    public function testItCalculatesPriceWithFixedCoupon(): void
    {
        $client = self::createClient();
        $data = [
            'product' => 1,
            'couponCode' => 'D20',
            'taxNumber' => 'IT12345678901',
        ];

        $client->jsonRequest('POST', '/calculate-price', $data);

        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(97.60, $responseData['totalPrice']);
    }

    public function testValidation(): void
    {
        $data = [
            'product' => 999,
            'couponCode' => 'WRONG',
            'taxNumber' => 'WROIT12345678901NG',
        ];

        self::createClient()->jsonRequest('POST', '/calculate-price', $data);

        $this->assertResponseStatusCodeSame(422);
    }
}
