<?php

declare(strict_types=1);

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

final readonly class PaypalAdapter implements PaymentAdapterInterface
{
    public function __construct(
        private PaypalPaymentProcessor $paypal
    ) {
    }

    public function pay(int $price): void
    {
        $this->paypal->pay($price);
    }
}
