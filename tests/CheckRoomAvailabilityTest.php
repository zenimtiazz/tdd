<?php

namespace App\Tests;
use App\Entity\Bookings;
use App\Entity\User;
use App\Entity\Room;
use DateTime;

use Monolog\Test\TestCase;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints\Date;

class CheckRoomAvailabilityTest extends TestCase
{
    private function dataProviderForPremiumRoom(): array
    {
        return [
            [true, true, true],
            [false, false, true],
            [false, true, true],
            [true, false, false]
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForPremiumRoom
     */
    public function testPremiumRoom(bool $roomVar, bool $userVar, bool $expectedOutput): void
    {

        $room = new Room($roomVar);
        $user = new User($userVar);
        $this->assertEquals($expectedOutput, $room->canBook($user));
    }

    private function dataProviderForbookings(): array
    {
        return [
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 05:40:30"), true],
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 10:12:30"), false],
            [new DateTime("2020-01-12 06:12:30"), new DateTime("2020-01-12 10:12:30"), true],
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 10:11:30"), false],


        ];
    }
    /**
     * function has to start with Test
     * @dataProvider dataProviderForbookings
     */
    public function testBookings(DateTime $Startdate, DateTime $Enddate,bool $expectedOutput): void
    {
        $bookings = new Bookings();


        $this->assertEquals($expectedOutput, $bookings->canBook($Startdate, $Enddate));

    }
}