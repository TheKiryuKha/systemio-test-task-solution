<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use App\Request\CalculatePriceRequest;
use App\Service\PriceCalculator\CouponModifier;
use App\Service\PriceCalculator\PriceCalculator;
use App\Service\PriceCalculator\TaxModifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CalculatePriceController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $pr,
        private readonly CouponRepository $cr,
        private readonly TaxRepository $tr,
    ) {
    }

    #[Route('/calculate-price', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] CalculatePriceRequest $request): JsonResponse
    {
        /** @var Product $product */
        $product = $this->pr->find($request->product);

        /** @var Coupon $coupon */
        $coupon = $this->cr->findOneByCode($request->couponCode);

        /** @var Tax $tax */
        $tax = $this->tr->findOneByCountryCode($request->taxNumber);

        $price = (new PriceCalculator($product))
            ->applyModifier(new CouponModifier($coupon))
            ->applyModifier(new TaxModifier($tax))
            ->calculate()
            ->getFinalPrice();

        return $this->json([
            'totalPrice' => $price,
            'currency' => 'EUR'
        ]);
    }
}
