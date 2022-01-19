<?php

namespace App\Entity;

use App\Repository\BookingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: BookingsRepository::class)]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'booking')]
    #[ORM\JoinColumn(nullable: true)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'booking', targetEntity: Room::class)]
    private $room;

    #[ORM\Column(type:'datetime',nullable: false)]
    private $Startdate;

    #[ORM\Column(type: 'datetime',nullable: false)]
    private $Enddate;

    public function __construct()
    {
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function __toString() {
        return $this->user();
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

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->Startdate;
    }

    public function setStartdate(DateTimeInterface $Startdate): self
    {
        $this->Startdate = $Startdate;

        return $this;
    }

    public function getEnddate(): ?DateTimeInterface
    {
        return $this->Enddate;
    }

    public function setEnddate(DateTimeInterface $Enddate): self
    {
        $this->Enddate = $Enddate;

        return $this;
    }
    function canBook($Startdate,$Enddate) {
        return ($this->getStartdate() && $user->getPremiumMember()) || !$this->getOnlyForPremiumMembers();
    }

}
