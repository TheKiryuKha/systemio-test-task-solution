<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Entity\Product;

final class PriceCalculator
{
    private int $price;

    /** @var array<ModifierInterface> */
    private array $modifiers;

    public function __construct(Product $product)
    {
        /** @var int $price */
        $price = $product->getPrice();

        $this->price = $price;
    }

    public function applyModifier(ModifierInterface $modifier): self
    {
        $this->modifiers[] = $modifier;

        return $this;
    }

    public function calculate(): self
    {
        foreach ($this->modifiers as $modifier) {
            $modifier->modify($this);
        }

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getFinalPrice(): float
    {
        return $this->price / 100;
    }
}
