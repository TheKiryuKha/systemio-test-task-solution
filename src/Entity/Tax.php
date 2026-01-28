<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TaxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxRepository::class)]
class Tax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 56)]
    private ?string $country_name = null;

    #[ORM\Column(length: 30)]
    private ?string $country_code = null;

    #[ORM\Column]
    private ?int $rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    public function setCountryName(string $country_name): static
    {
        $this->country_name = $country_name;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }
}
