<?php

namespace App\DataFixtures;

use App\Entity\Bookings;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $booking = new Bookings();
        $booking->setUsername("Razi");
        $booking->setStartdate('2022-01-17T14:42:27+00:00' );
        $booking->setEnddate('2022-01-20T14:42:27+00:00' );

        $manager->persist($booking);



        $manager->flush();
        $this->addReference('booking_1',$booking);
    }
}
