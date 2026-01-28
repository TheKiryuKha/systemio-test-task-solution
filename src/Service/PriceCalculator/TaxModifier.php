<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Entity\Tax;

final readonly class TaxModifier implements ModifierInterface
{
    public function __construct(
        private Tax $tax
    ) {
    }

    public function modify(PriceCalculator $calculator): void
    {
        $price = $calculator->getPrice();

        $taxAmount = (int) round($price * $this->tax->getRate() / 100);

        $calculator->setPrice($price + $taxAmount);
    }
}
