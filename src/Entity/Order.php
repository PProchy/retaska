<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jmeno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prijmeni;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ulice;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mesto;

    /**
     * @ORM\Column(type="integer")
     */
    private $psc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zeme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Transport", inversedBy="orders")
     */
    private $doprava;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment", inversedBy="orders")
     */
    private $platba;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $poznamka;

    /**
     * @ORM\Column(type="integer")
     */
    private $celkovaCena;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *     min="1"
     * )
     */
    private $ks;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stav;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelefon(): ?int
    {
        return $this->telefon;
    }

    public function setTelefon(int $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): self
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getUlice(): ?string
    {
        return $this->ulice;
    }

    public function setUlice(string $ulice): self
    {
        $this->ulice = $ulice;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getMesto(): ?string
    {
        return $this->mesto;
    }

    public function setMesto(string $mesto): self
    {
        $this->mesto = $mesto;

        return $this;
    }

    public function getPsc(): ?int
    {
        return $this->psc;
    }

    public function setPsc(int $psc): self
    {
        $this->psc = $psc;

        return $this;
    }

    public function getZeme(): ?Country
    {
        return $this->zeme;
    }

    public function setZeme(?Country $zeme): self
    {
        $this->zeme = $zeme;

        return $this;
    }

    public function getDoprava(): ?Transport
    {
        return $this->doprava;
    }

    public function setDoprava(?Transport $doprava): self
    {
        $this->doprava = $doprava;

        return $this;
    }

    public function getPlatba(): ?Payment
    {
        return $this->platba;
    }

    public function setPlatba(?Payment $platba): self
    {
        $this->platba = $platba;

        return $this;
    }

    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    public function setPoznamka(?string $poznamka): self
    {
        $this->poznamka = $poznamka;

        return $this;
    }

    public function getCelkovaCena(): ?int
    {
        return $this->celkovaCena;
    }

    public function setCelkovaCena(int $celkovaCena): self
    {
        $this->celkovaCena = $celkovaCena;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getKs(): ?int
    {
        return $this->ks;
    }

    public function setKs(int $ks): self
    {
        $this->ks = $ks;

        return $this;
    }

    public function getStav(): ?string
    {
        return $this->stav;
    }

    public function setStav(string $stav): self
    {
        $this->stav = $stav;

        return $this;
    }
}
