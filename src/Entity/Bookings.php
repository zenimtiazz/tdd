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
    public function canBook(DateTime $Startdate, DateTime $Enddate) {

        $time_diff = $Startdate->diff($Enddate);
        $time_diff->h . ' hours';
        $time_diff->i . ' minutes';
        $time_diff->s . ' seconds';

        if($time_diff->i >0 && $time_diff->h==4){
            return false;
        }
        elseif ($time_diff->h == 4 ||  $time_diff->h < 4 ) {
            return true;
        }

           else {
               return false;
           }

    }
    public  function checkSameBooking(DateTime $start1, DateTime $end1, DateTime $start2, DateTime $end2)
    {

        $startTime1 = $start1->gettimestamp();
        $startTime2 = $start2->gettimestamp();
        $endTime1 = $end1->gettimestamp();
        $endTime2 = $end2->gettimestamp();

        if($startTime2 > $startTime1 && $startTime2 < $endTime1){
            return false;
        }elseif($endTime2 < $endTime1 && $endTime2 > $startTime1){
            return false;
        }elseif($startTime2 == $startTime1 && $endTime2 == $endTime1){
            return false;
        }else{
            return true;
        }
    }

}
