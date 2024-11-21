<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $new = new News();
            $new->setTitle("Title News: Number $i");
            $new->setContent("Content News: Number $i...");
            $new->setDatePublished(new \DateTime());

            $manager->persist($new);
        }

        $manager->flush();
    }
}
