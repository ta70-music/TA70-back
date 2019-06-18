<?php

namespace App\DataFixtures;

use App\Entity\Music;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $music = new Music();
        $music->setFile('song.mp3');
        $music->setTitle('song');

        $music2 = new Music();
        $music2->setFile('song2.mp3');
        $music2->setTitle('song2');

        $manager->persist($music2);
        $manager->persist($music);
        $manager->flush();
    }
}
