<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
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
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="zeme")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="country")
     */
    private $ordersNew;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->ordersNew = new ArrayCollection();
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
            $order->setZeme($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getZeme() === $this) {
                $order->setZeme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrdersNew(): Collection
    {
        return $this->ordersNew;
    }

    public function addOrdersNew(Orders $ordersNew): self
    {
        if (!$this->ordersNew->contains($ordersNew)) {
            $this->ordersNew[] = $ordersNew;
            $ordersNew->setCountry($this);
        }

        return $this;
    }

    public function removeOrdersNew(Orders $ordersNew): self
    {
        if ($this->ordersNew->contains($ordersNew)) {
            $this->ordersNew->removeElement($ordersNew);
            // set the owning side to null (unless already changed)
            if ($ordersNew->getCountry() === $this) {
                $ordersNew->setCountry(null);
            }
        }

        return $this;
    }
}
