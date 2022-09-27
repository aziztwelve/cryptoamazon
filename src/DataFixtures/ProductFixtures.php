<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const IPHONE_PRODUCT_REFERENCE = 'iphone-product';
    public const HONOR_PRODUCT_REFERENCE = 'honor-product';

    public function load(ObjectManager $manager): void
    {
        /** @var Manufacturer $samsungManufacturer */
        $samsungManufacturer = $this->getReference(ManufacturerFixtures::SAMSUNG_MANUFACTURER_REFERENCE);
        /** @var Manufacturer $appleManufacturer */
        $appleManufacturer = $this->getReference(ManufacturerFixtures::APPLE_MANUFACTURER_REFERENCE);
        /** @var Manufacturer $xiaomiManufacturer */
        $xiaomiManufacturer = $this->getReference(ManufacturerFixtures::XIAOMI_MANUFACTURER_REFERENCE);
        /** @var Manufacturer $huaweiManufacturer */
        $huaweiManufacturer = $this->getReference(ManufacturerFixtures::HUAWEI_MANUFACTURER_REFERENCE);


        $androidCategory = $this->getReference(CategoryFixtures::ANDROID_CATEGORY_REFERENCE);
        $iosCategory = $this->getReference(CategoryFixtures::IOS_CATEGORY_REFERENCE);
        $nfcCategory = $this->getReference(CategoryFixtures::NFC_CATEGORY_REFERENCE);
        $blackCategory = $this->getReference(CategoryFixtures::BLACK_CATEGORY_REFERENCE);
        $whiteCategory = $this->getReference(CategoryFixtures::WHITE_CATEGORY_REFERENCE);
        $greenCategory = $this->getReference(CategoryFixtures::GREEN_CATEGORY_REFERENCE);

        $iphoneProduct = (new Product())
            ->setName('iPhone 13')
            ->setDescription('content')
            ->setPrice(564)
            ->setSlug('iphone-13')
            ->setManufacturer($appleManufacturer)
            ->setCategories(new ArrayCollection([$iosCategory, $nfcCategory, $whiteCategory]));
        $honorProduct = (new Product())
            ->setName('honor 20')
            ->setDescription('content')
            ->setPrice(654)
            ->setSlug('honor-20')
            ->setManufacturer($huaweiManufacturer)
            ->setCategories(new ArrayCollection([$androidCategory, $nfcCategory, $blackCategory]));
        $products = [
            self::IPHONE_PRODUCT_REFERENCE => $iphoneProduct,
            self::HONOR_PRODUCT_REFERENCE => $honorProduct,
        ];

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->persist((new Product())
            ->setName('samsung A51')
            ->setDescription('content')
            ->setPrice(599.2)
            ->setSlug('samsung-a51')
            ->setManufacturer($samsungManufacturer)
            ->setCategories(new ArrayCollection([$androidCategory, $nfcCategory, $blackCategory]))
        );
        $manager->persist((new Product())
            ->setName('redmi 8 note')
            ->setDescription('content')
            ->setPrice(235.2)
            ->setSlug('redmi-8-note')
            ->setManufacturer($xiaomiManufacturer)
            ->setCategories(new ArrayCollection([$androidCategory, $greenCategory]))
        );

        $manager->flush();

        foreach ($products as $code => $product) {
            $this->addReference($code, $product);
        }
    }

    public function getDependencies(): array
    {
        return [
            ManufacturerFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
