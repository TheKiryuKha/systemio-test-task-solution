<?php

declare(strict_types=1);

namespace App\Service\Payment;

final class Payer
{
    private PaymentAdapterInterface $adapter;

    public function __construct(
        private readonly PaymentFactory $factory
    ) {
    }

    public function use(string $processor): self
    {
        $this->adapter = $this->factory->create($processor);

        return $this;
    }

    public function pay(int $price): void
    {
        $this->adapter->pay($price);
    }
}
