<?php

namespace App\DataFixtures;

use App\Entity\Room;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\True_;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

    }
}
