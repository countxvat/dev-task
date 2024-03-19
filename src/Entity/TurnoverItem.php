<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TurnoverItem.
 *
 * @ORM\Table(name="turnover_item")
 * @ORM\Entity()
 */
class TurnoverItem
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Turnover", inversedBy="turnoverItemList")
     * @ORM\JoinColumn(name="turnover_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private Turnover $turnover;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_vat_rate", type="decimal", precision=15, scale=2, nullable=false)
     */
    private string $invoiceVatRate;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_net_amount", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same vat rate, new"} )
     */
    private ?int $invoiceTotalNetAmount;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_brutto_amount", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same brutto in original currency."} )
     */
    private ?int $invoiceTotalBruttoAmount = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_vat_amount", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same vat in original currency"} )
     */
    private ?int $invoiceTotalVatAmount = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_net_amount_eur", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same netto in EUR."} )
     */
    private ?int $invoiceTotalNetAmountEUR = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_brutto_amount_eur", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same brutto in EUR."} )
     */
    private ?int $invoiceTotalBruttoAmountEUR = null;

    /**
     * @Serializer\Groups({"api"})
     *
     * @ORM\Column(name="invoice_total_vat_amount_eur", nullable=true, type="integer", options={"comment":"This amount is the sum of all products of a turnover within the same vat in EUR."} )
     */
    private ?int $invoiceTotalVatAmountEUR = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTurnover(): Turnover
    {
        return $this->turnover;
    }

    public function setTurnover(Turnover $turnover): self
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getInvoiceVatRate(): float
    {
        return (float) $this->invoiceVatRate;
    }

    public function setInvoiceVatRate(float $invoiceVatRate): self
    {
        $this->invoiceVatRate = (string) $invoiceVatRate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalBruttoAmount(): ?int
    {
        return $this->invoiceTotalBruttoAmount;
    }

    /**
     * @param int|null $invoiceTotalBruttoAmount
     * @return $this
     */
    public function setInvoiceTotalBruttoAmount(?int $invoiceTotalBruttoAmount): self
    {
        $this->invoiceTotalBruttoAmount = $invoiceTotalBruttoAmount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalVatAmount(): ?int
    {
        return $this->invoiceTotalVatAmount;
    }

    /**
     * @param int|null $invoiceTotalVatAmount
     * @return $this
     */
    public function setInvoiceTotalVatAmount(?int $invoiceTotalVatAmount): self
    {
        $this->invoiceTotalVatAmount = $invoiceTotalVatAmount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalNetAmountEUR(): ?int
    {
        return $this->invoiceTotalNetAmountEUR;
    }

    /**
     * @param int|null $invoiceTotalNetAmountEUR
     * @return $this
     */
    public function setInvoiceTotalNetAmountEUR(?int $invoiceTotalNetAmountEUR): self
    {
        $this->invoiceTotalNetAmountEUR = $invoiceTotalNetAmountEUR;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalBruttoAmountEUR(): ?int
    {
        return $this->invoiceTotalBruttoAmountEUR;
    }

    /**
     * @param int|null $invoiceTotalBruttoAmountEUR
     * @return $this
     */
    public function setInvoiceTotalBruttoAmountEUR(?int $invoiceTotalBruttoAmountEUR): self
    {
        $this->invoiceTotalBruttoAmountEUR = $invoiceTotalBruttoAmountEUR;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalVatAmountEUR(): ?int
    {
        return $this->invoiceTotalVatAmountEUR;
    }

    /**
     * @param int|null $invoiceTotalVatAmountEUR
     * @return $this
     */
    public function setInvoiceTotalVatAmountEUR(?int $invoiceTotalVatAmountEUR): self
    {
        $this->invoiceTotalVatAmountEUR = $invoiceTotalVatAmountEUR;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInvoiceTotalNetAmount(): ?int
    {
        return $this->invoiceTotalNetAmount;
    }

    /**
     * @param int|null $invoiceTotalNetAmount
     * @return $this
     */
    public function setInvoiceTotalNetAmount(?int $invoiceTotalNetAmount): self
    {
        $this->invoiceTotalNetAmount = $invoiceTotalNetAmount;

        return $this;
    }
}
