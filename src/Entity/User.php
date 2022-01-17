<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $username;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 20)]
    private string $password;

    #[ORM\Column(type: 'integer', options: ['default' => 100])]
    private int $credit;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $premiumMember;

    #[ORM\OneToMany(mappedBy: 'username', targetEntity: Bookings::class)]
    private username $booking;

    #[Pure] public function __construct()
    {
        $this->booking = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getPremiumMember(): ?bool
    {
        return $this->premiumMember;
    }

    public function setPremiumMember(bool $premiumMember): self
    {
        $this->premiumMember = $premiumMember;

        return $this;
    }

    /**
     * @return Collection|Bookings[]
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(Bookings $booking): self
    {
        if (!$this->booking->contains($booking)) {
            $this->booking[] = $booking;
            $booking->setUsername($this);
        }

        return $this;
    }

    public function removeBooking(Bookings $booking): self
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getUsername() === $this) {
                $booking->setUsername(null);
            }
        }

        return $this;
    }
}
