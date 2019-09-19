<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_iban")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 */
class VendorsIban
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", nullable=false, options={"default"="0"})
     */
    private $iban = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="expires_end", type="string", nullable=false, options={"default"="0"})
	 */
    private $expiresEnd = '0';

	/**
	 * @var int
	 *
	 * @ORM\Column(name="signature_code", type="smallint", nullable=false, options={"default" : 0})
	 */
    private $signatureCode = 0;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", cascade={"persist", "remove"}, inversedBy="vendorIban", orphanRemoval=true)
     * @ORM\JoinColumn(name="vendorIban_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
	private $vendorIban;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban(string $iban): void
    {
        $this->iban = $iban;
    }

	/**
	 * @return mixed
	 */
	public function getVendorIban()
	{
		return $this->vendorIban;
	}

	/**
	 * @param mixed $vendorIban
	 */
	public function setVendorIban($vendorIban): void
	{
		$this->vendorIban = $vendorIban;
	}

	/**
	 * @return string
	 */
	public function getExpiresEnd(): string
	{
		return $this->expiresEnd;
	}

	/**
	 * @param string $expiresEnd
	 */
	public function setExpiresEnd(string $expiresEnd): void
	{
		$this->expiresEnd = $expiresEnd;
	}

	/**
	 * @return int
	 */
	public function getSignatureCode(): int
	{
		return $this->signatureCode;
	}

	/**
	 * @param int $signatureCode
	 */
	public function setSignatureCode(int $signatureCode): void
	{
		$this->signatureCode = $signatureCode;
	}


}
