<?php

declare(strict_types=1);

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

final readonly class StripeAdapter implements PaymentAdapterInterface
{
    public function __construct(
        private StripePaymentProcessor $stripe
    ) {
    }

    public function pay(int $price): void
    {
        $this->stripe->processPayment($price / 100);
    }
}
