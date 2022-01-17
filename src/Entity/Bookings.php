<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'booking')]
    #[ORM\JoinColumn(nullable: false)]
    private $username;

    #[ORM\OneToMany(mappedBy: 'booking', targetEntity: Room::class)]
    private $room;

    #[ORM\Column(type: 'datetime')]
    private string $Startdate;

    #[ORM\Column(type: 'datetime')]
    private string $Enddate;

    #[Pure] public function __construct()
    {
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room[] = $room;
            $room->setBooking($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getBooking() === $this) {
                $room->setBooking(null);
            }
        }

        return $this;
    }

    public function getStartdate(): ?string
    {
        return $this->Startdate;
    }

    public function setStartdate(string $Startdate): self
    {
        $this->Startdate = $Startdate;

        return $this;
    }

    public function getEnddate(): ?string
    {
        return $this->Enddate;
    }

    public function setEnddate(string $Enddate): self
    {
        $this->Enddate = $Enddate;

        return $this;
    }
}
