<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Enums\CouponType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadProducts($manager);
        $this->loadCoupons($manager);
        $this->loadTaxes($manager);
    }

    private function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProductsData() as [$title, $price]) {
            $product = new Product();
            $product->setTitle($title);
            $product->setPrice($price);

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function loadCoupons(ObjectManager $manager): void
    {
        foreach ($this->getCouponsData() as [$type, $value, $code]) {
            $coupon = new Coupon();
            $coupon->setType($type);
            $coupon->setValue($value);
            $coupon->setCode($code);

            $manager->persist($coupon);
        }

        $manager->flush();
    }

    private function loadTaxes(ObjectManager $manager): void
    {
        foreach ($this->getTaxesData() as [$country_name, $country_code, $rate]) {
            $tax = new Tax();
            $tax->setCountryName($country_name);
            $tax->setCountryCode($country_code);
            $tax->setRate($rate);

            $manager->persist($tax);
        }

        $manager->flush();
    }

    /**
     * @return list<array{string, int}>
     */
    private function getProductsData(): array
    {
        return [
            // $productData = [$title, $price];
            ['Iphone', 100],
            ['Headphones', 20],
            ['Case', 10],
        ];
    }

    /**
     * @return list<array{CouponType, int, string}>
     */
    private function getCouponsData(): array
    {
        return [
            //  $couponData = [$type, $value, $code]
            [CouponType::Fixed, 10, 'D10'],
            [CouponType::Discount, 25, 'P25'],
            [CouponType::Discount, 100, 'P100'],
        ];
    }

    /**
     * @return list<array{string, string, int}>
     */
    private function getTaxesData(): array
    {
        return [
            // $taxData = [$country_name, $country_code, $rate]
            ['Germany', 'DE309876543', 19],
            ['Italy', 'IT12345678901', 22],
            ['France', 'FRKZ012345678', 20],
            ['Greece', 'GR987654321', 24],
        ];
    }
}
