<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $onlyForPremiumMembers;

    #[ORM\ManyToOne(targetEntity: Bookings::class, inversedBy: 'room')]
    #[ORM\JoinColumn(nullable: false)]
    private  $booking;
    public function __construct(bool $isPremium)
    {
        $this->booking = new ArrayCollection();
        $this->onlyForPremiumMembers = $isPremium;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOnlyForPremiumMembers(): ?bool
    {
        return $this->onlyForPremiumMembers;
    }

    public function setOnlyForPremiumMembers(?bool $onlyForPremiumMembers): self
    {
        $this->onlyForPremiumMembers = $onlyForPremiumMembers;

        return $this;
    }

    public function getBooking(): ?Bookings
    {
        return $this->booking;
    }

    public function setBooking(?int $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    function canBook(User $user) {
        return ($this->getOnlyForPremiumMembers() && $user->getPremiumMember()) || !$this->getOnlyForPremiumMembers();
    }
    public function reservedDates(ManagerRegistry $doctrine): array
    {
        $entityManager = $doctrine->getManager();
        $room = $entityManager->getRepository(Room::class)->find($this->getId());

        $bookings = $room->getBookings()->unwrap();
        $reservedDates = [];

        foreach ($bookings as &$value) {
            $reservedDates[] = ['start' => $value->getStartDate(), 'end' => $value->getEndDate()];
        }
        return $reservedDates;
    }

    public function isAvailable(DateTime $startDate, DateTime $endDate, array $reservedDates): bool
    {
        $check = true;
        foreach ($reservedDates as &$value) {
            if ($startDate->getTimestamp() > $value['start']->getTimestamp() && $startDate->getTimestamp() < $value['end']->getTimestamp()) {
                $check = false; // new start > old start AND new start < old end
            } elseif ($endDate->getTimestamp() > $value['start']->getTimestamp() && $endDate->getTimestamp() < $value['end']->getTimestamp()) {
                $check = false; // new end > old start AND new end < old end
            } elseif ($startDate->getTimestamp() <= $value['start']->getTimestamp() && $endDate->getTimestamp() > $value['end']->getTimestamp()) {
                $check = false; // new start < old start AND new end > old end
            } elseif ($startDate->getTimestamp() > $value['start']->getTimestamp() && $endDate->getTimestamp() == $value['end']->getTimestamp()) {
                $check = false; // new start > old start AND new end == old end
            } elseif ($startDate->getTimestamp() == $value['start']->getTimestamp() && $endDate->getTimestamp() == $value['end']->getTimestamp())
                $check = false; // if dates of the bookings exactly match
        }
        if ($startDate->getTimestamp() < $endDate->getTimestamp()) {
            $check = false;
        }
        return $check;
    }


}
