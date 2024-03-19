<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Country.
 *
 * @ORM\Table(name="country")
 *
 * @ORM\Entity()
 */
class Country
{
    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="short_name", type="string", length=10, nullable=false)
     */
    private string $shortName;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private string $name;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="is_eu", type="boolean", options={"default": false}, nullable=false)
     */
    private bool $isEu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private Currency $currency;

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isEu(): bool
    {
        return $this->isEu;
    }

    public function setIsEu(bool $isEu): void
    {
        $this->isEu = $isEu;
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
