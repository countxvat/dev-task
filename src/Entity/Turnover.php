<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="turnover")
 * @ORM\Entity()
 */
class Turnover
{
    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private Client $client;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Country")
     * @ORM\JoinColumn(name="departure_country_id", referencedColumnName="id", nullable=false)
     */
    private Country $departureCountry;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Country")
     * @ORM\JoinColumn(name="arrival_country_id", referencedColumnName="id", nullable=false)
     */
    private Country $arrivalCountry;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="document_number", type="string", nullable=false)
     */
    private string $documentNumber;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="document_date", type="date", nullable=false)
     */
    private \DateTime $documentDate;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Country")
     * @ORM\JoinColumn(name="vat_country_id", referencedColumnName="id", nullable=false)
     */
    private Country $vatCountry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private Currency $currency;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="zip_code", type="string", nullable=true)
     */
    private ?string $zipCode = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="city", length=255, type="string", nullable=true)
     */
    private ?string $city = null;

    /**
     * @ORM\Column(name="is_oss", type="boolean", options={"default": false}, nullable=false)
     */
    private bool $isOss = false;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\OneToMany(targetEntity="App\Entity\TurnoverItem", mappedBy="turnover", cascade={"persist", "remove"})
     */
    protected Collection $turnoverItemList;

    public function __construct()
    {
        $this->turnoverItemList = new ArrayCollection();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function getDepartureCountry(): Country
    {
        return $this->departureCountry;
    }

    public function setDepartureCountry(Country $departureCountry): void
    {
        $this->departureCountry = $departureCountry;
    }

    public function getArrivalCountry(): Country
    {
        return $this->arrivalCountry;
    }

    public function setArrivalCountry(Country $arrivalCountry): void
    {
        $this->arrivalCountry = $arrivalCountry;
    }

    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber(string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
    }

    public function getDocumentDate(): \DateTime
    {
        return $this->documentDate;
    }

    public function setDocumentDate(\DateTime $documentDate): void
    {
        $this->documentDate = $documentDate;
    }

    public function getVatCountry(): Country
    {
        return $this->vatCountry;
    }

    public function setVatCountry(Country $vatCountry): void
    {
        $this->vatCountry = $vatCountry;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function isOss(): bool
    {
        return $this->isOss;
    }

    public function setIsOss(bool $isOss): void
    {
        $this->isOss = $isOss;
    }

    public function getTurnoverItemList(): Collection
    {
        return $this->turnoverItemList;
    }

    public function setTurnoverItemList(Collection $turnoverItemList): void
    {
        $this->turnoverItemList = $turnoverItemList;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }
}
