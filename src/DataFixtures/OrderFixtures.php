<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public const USER1_ORDER_REFERENCE = 'order-user1';
    public const USER2_ORDER_REFERENCE = 'order-user2';

    public function load(ObjectManager $manager): void
    {
        $order1 = (new Order())
            ->setFirstname('Byrom')
            ->setLastname('Ketchaside')
            ->setEmail('bketchaside0@howstuffworks.com')
            ->setTelephone('+7 956 846 1254')
            ->setTotal(1218)
            ->setPaymentMethod('card');
        $order2 = (new Order())
            ->setFirstname('Thain')
            ->setLastname('Tremathack')
            ->setEmail('ttremathack1@tripod.com')
            ->setTelephone('+7 354 846 945')
            ->setTotal(564)
            ->setPaymentMethod('card');
        $manager->persist($order1);
        $manager->persist($order2);

        $manager->flush();

        $this->addReference(self::USER1_ORDER_REFERENCE, $order1);
        $this->addReference(self::USER2_ORDER_REFERENCE, $order2);
    }
}
