<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\Column(type: 'bool', options: ['default' => false])]
    private bool $onlyForPremiumMembers;

    #[ORM\ManyToOne(targetEntity: Bookings::class, inversedBy: 'room')]
    #[ORM\JoinColumn(nullable: false)]
    private int $booking;

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

    public function setOnlyForPremiumMembers(bool $onlyForPremiumMembers): self
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
}
