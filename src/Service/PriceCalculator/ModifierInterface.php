<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

interface ModifierInterface
{
    public function modify(PriceCalculator $calculator): void;
}
