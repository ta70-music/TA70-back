<?php


namespace App\DataFixtures;

use App\Domain\Model\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $music = new Music();
        $music->setFile($faker->text(10) . 'mp3');
        $music->setTitle($faker->text(10));

        $music2 = new Music();
        $music2->setFile($faker->text(10) . 'mp3');
        $music2->setTitle($faker->text(10));


        $manager->persist($music);
        $manager->persist($music2);
        $manager->flush();
    }
}