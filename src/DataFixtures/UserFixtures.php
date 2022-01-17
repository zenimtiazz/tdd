<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername("Razi");
        $user->setEmail("raazia@gmail.com");
        $user->setPassword(1234);
        $user->setCredit(2000);
        $user->setPremiumMember('true');
       $user->addBooking($this->getReference('booking_1'));
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername("hani");
        $user2->setEmail("hani@gmail.com");
        $user2->setPassword(7878);
        $user2->setCredit(6789);
        $user2->setPremiumMember('true');
        $user->addBooking($this->getReference('booking_1'));
        $manager->persist($user2);


        $manager->flush();
    }
}
