<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportRepository")
 */
class Transport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="doprava")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="transport")
     */
    private $orderNew;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->orderNew = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setDoprava($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getDoprava() === $this) {
                $order->setDoprava(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrderNew(): Collection
    {
        return $this->orderNew;
    }

    public function addOrderNew(Orders $orderNew): self
    {
        if (!$this->orderNew->contains($orderNew)) {
            $this->orderNew[] = $orderNew;
            $orderNew->setTransport($this);
        }

        return $this;
    }

    public function removeOrderNew(Orders $orderNew): self
    {
        if ($this->orderNew->contains($orderNew)) {
            $this->orderNew->removeElement($orderNew);
            // set the owning side to null (unless already changed)
            if ($orderNew->getTransport() === $this) {
                $orderNew->setTransport(null);
            }
        }

        return $this;
    }
}
