<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixtures extends Fixture
{
    public const SAMSUNG_MANUFACTURER_REFERENCE = 'samsung-manufacturer';
    public const APPLE_MANUFACTURER_REFERENCE = 'apple-manufacturer';
    public const XIAOMI_MANUFACTURER_REFERENCE = 'xiaomi-manufacturer';
    public const HUAWEI_MANUFACTURER_REFERENCE = 'huawei-manufacturer';

    public function load(ObjectManager $manager): void
    {
        $manufacturers = [
          self::SAMSUNG_MANUFACTURER_REFERENCE => (new Manufacturer())->setName('Samsung'),
          self::APPLE_MANUFACTURER_REFERENCE => (new Manufacturer())->setName('Apple'),
          self::XIAOMI_MANUFACTURER_REFERENCE => (new Manufacturer())->setName('Xiaomi'),
          self::HUAWEI_MANUFACTURER_REFERENCE => (new Manufacturer())->setName('Huawei'),
        ];

        foreach ($manufacturers as $manufacturer) {
            $manager->persist($manufacturer);
        }

        $manager->flush();

        foreach ($manufacturers as $code => $manufacturer) {
            $this->addReference($code, $manufacturer);
        }
    }
}
