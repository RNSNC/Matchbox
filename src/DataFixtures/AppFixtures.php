<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Entity\Purpose;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Назначение спичек
        $purposeOne = $this::createObjectWithName(Purpose::class, 'Кухонные');
        $manager->persist($purposeOne);
        $purposeTwo = $this::createObjectWithName(Purpose::class, 'Кемпинг');
        $manager->persist($purposeTwo);

        //Производитель
        $manufacturerOne = $this::createObjectWithName(Manufacturer::class, 'Пинскдрев');
        $manager->persist($manufacturerOne);
        $manufacturerTwo = $this::createObjectWithName(Manufacturer::class, 'Берёзка');
        $manager->persist($manufacturerTwo);

        $manager->flush();
    }

    public static function createObjectWithName(string $class, string $name): object
    {
        $entity = new $class();
        return $entity->setName($name);
    }
}
