<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class Money
{
    #[ORM\Column]
    public int $price;

    public function getPrice(): int
    {
        return $this->price;
    }

    // public static function fromEuros(float $euros): self
    // {
    //     return new self
    // }
}
