<?php

declare(strict_types=1);

namespace App\Request;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use Happyr\Validator\Constraint\EntityExist;
use Symfony\Component\Validator\Constraints as Assert;

final class PayRequest
{
    #[Assert\NotNull(message: 'Product ID is required')]
    #[Assert\Type('integer')]
    #[EntityExist(Product::class, 'id', 'This Product does not exist')]
    public int $product;

    #[Assert\NotBlank(message: 'Coupon code is required')]
    #[Assert\Type('string')]
    #[Assert\Length(max: 20, maxMessage: 'Coupon code is too long')]
    #[EntityExist(Coupon::class, 'code', 'This Coupon does not exist')]
    public string $couponCode;

    #[Assert\NotBlank(message: 'Tax number cannot is required')]
    #[Assert\Type('string')]
    #[EntityExist(Tax::class, 'country_code', 'This Country does not exists')]
    public string $taxNumber;

    #[Assert\NotBlank(message: 'Tax number cannot is required')]
    #[Assert\Type('string')]
    #[Assert\Choice(
        choices: ['paypal', 'stripe'],
        message: 'Invalid payment processor. Valid options: paypal, stripe'
    )]
    public string $paymentProcessor;
}
