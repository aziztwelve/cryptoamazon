<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const ANDROID_CATEGORY_REFERENCE = 'android-category';
    public const IOS_CATEGORY_REFERENCE = 'ios-category';
    public const NFC_CATEGORY_REFERENCE = 'nfc-category';
    public const BLACK_CATEGORY_REFERENCE = 'black-category';
    public const WHITE_CATEGORY_REFERENCE = 'white-category';
    public const GREEN_CATEGORY_REFERENCE = 'green-category';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::ANDROID_CATEGORY_REFERENCE => (new Category())->setName('Android'),
            self::IOS_CATEGORY_REFERENCE => (new Category())->setName('iOS'),
            self::NFC_CATEGORY_REFERENCE => (new Category())->setName('NFC'),
            self::BLACK_CATEGORY_REFERENCE => (new Category())->setName('Black'),
            self::WHITE_CATEGORY_REFERENCE => (new Category())->setName('White'),
            self::GREEN_CATEGORY_REFERENCE => (new Category())->setName('Green'),
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }

        $manager->flush();

        foreach ($categories as $code => $category) {
            $this->addReference($code, $category);
        }
    }
}
