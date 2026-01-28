<?php

declare(strict_types=1);

namespace App\Service\Payment;

use InvalidArgumentException;

final readonly class PaymentFactory
{
    public function __construct(
        private PaypalAdapter $paypalAdapter,
        private StripeAdapter $stripeAdapter,
    ) {
    }

    public function create(string $processor): PaymentAdapterInterface
    {
        return match ($processor) {
            'paypal' => $this->paypalAdapter,
            'stripe' => $this->stripeAdapter,
            default => throw new InvalidArgumentException(
                sprintf('Unknown payment processor: "%s"', $processor)
            )
        };
    }
}
