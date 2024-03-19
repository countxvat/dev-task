<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="turnover")
 * @ORM\Entity()
 */
class Turnover
{
    /**
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
     * @ORM\ManyToOne(targetEntity="\App\Entity\Country")
     * @ORM\JoinColumn(name="departure_country_id", referencedColumnName="id", nullable=false)
     */
    private Country $departureCountry;

    /**
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Country")
     * @ORM\JoinColumn(name="arrival_country_id", referencedColumnName="id", nullable=false)
     */
    private Country $arrivalCountry;

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
}
