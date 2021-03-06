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
    public function dataProviderCanAfford(): array
    {
        return [
            [new User(), 100 , 3 , true],
            [new User(),50,4, false],
            [new User(),150,3, true],
            [new User(),20,5,false]
        ];
    }
    /**
     * function has to start with Test
     * @dataProvider dataProviderCanAfford
     */
    public function canAfford(User $user, int $credit, int $bookings, bool $expectedOutput): void
    {
        $user = new User();
        $user->setCredit();
        $this->assertEquals($expectedOutput, $user->canAfford($user, $bookings));

    }
    public function dataProviderForTestSameBooming()
    {
        return [
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 11:05:05'), new DateTime('2020-12-12 15:05:05'), false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 09:05:05'), new DateTime('2020-12-12 13:05:05'), false],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 18:05:05'), true],
            [new DateTime('2020-12-12 06:05:05'), new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), true],
            [new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), new DateTime('2020-12-12 10:05:05'), new DateTime('2020-12-12 14:05:05'), false],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForTestSameBooming
     */
    public function testSameBooming(DateTime $start1, DateTime $end1, DateTime $start2, DateTime $end2, bool $expectedOutput)
    {
        $booking = new Bookings();
        $this->assertEquals($expectedOutput, $booking->checkSameBooking($start1, $end1, $start2, $end2));

    }
}