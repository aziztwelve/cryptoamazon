<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Order $order1 */
        $order1 = $this->getReference(OrderFixtures::USER1_ORDER_REFERENCE);
        /** @var Order $order2 */
        $order2 = $this->getReference(OrderFixtures::USER2_ORDER_REFERENCE);

        /** @var Product $iphoneProduct */
        $iphoneProduct = $this->getReference(ProductFixtures::IPHONE_PRODUCT_REFERENCE);
        /** @var Product $honorProduct */
        $honorProduct = $this->getReference(ProductFixtures::HONOR_PRODUCT_REFERENCE);

        $manager->persist((new OrderProduct())
            ->setQuantity(1)
            ->setTotal(564)
            ->setPrice(564)
            ->setOrder($order1)
            ->setProduct($iphoneProduct)
        );
        $manager->persist((new OrderProduct())
            ->setQuantity(1)
            ->setTotal(564)
            ->setPrice(564)
            ->setOrder($order2)
            ->setProduct($iphoneProduct)
        );
        $manager->persist((new OrderProduct())
            ->setQuantity(1)
            ->setTotal(654)
            ->setPrice(654)
            ->setOrder($order2)
            ->setProduct($honorProduct)
        );

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
            ProductFixtures::class,
        ];
    }
}
