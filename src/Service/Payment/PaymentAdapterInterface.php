<?php

declare(strict_types=1);

namespace App\Service\Payment;

interface PaymentAdapterInterface
{
    public function pay(int $price): void;
}
