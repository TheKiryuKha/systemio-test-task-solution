<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Entity\Coupon;
use App\Enum\CouponType;

final readonly class CouponModifier implements ModifierInterface
{
    public function __construct(
        private Coupon $coupon
    ) {
    }

    /**
     * @todo refactor to Money value object
     */
    public function modify(PriceCalculator $calculator): void
    {
        $price = $calculator->getPrice();

        if ($this->coupon->getType() === CouponType::Fixed) {
            $price -= $this->coupon->getValue() * 100;
        } else {
            $price -= $price * $this->coupon->getValue() / 100;
        }

        $calculator->setPrice($price);
    }
}
