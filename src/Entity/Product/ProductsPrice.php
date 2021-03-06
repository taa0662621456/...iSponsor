<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\BaseTrait;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_price", indexes={
 * @ORM\Index(name="product_price_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductsRepository")
 */
class ProductsPrice
{
	use BaseTrait;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="product_id", type="integer", nullable=false, options={"default" : 0})
	 */
	private $productId = 0;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="shopper_group_id", type="integer", nullable=false, options={"default" : 0})
	 */
	private $shopperGroupId = 0;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productPrice")
	 * @ORM\JoinColumn(name="productPrice_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
	 */
	private $productPrice = 0;

	/**
	 * @var boolean|null
	 *
	 * @ORM\Column(name="override", type="boolean", nullable=true, options={"default" : 0})
	 */
	private $override = false;

	/**
	 * @var
	 *
	 * @ORM\Column(name="product_override_price", type="decimal", precision=7, scale=2, nullable=true,
	 *                                            options={"default" : 0})
	 */
	private $productOverridePrice = 0;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="product_tax_id", type="integer", nullable=true, options={"default" : 0})
	 */
	private $productTaxId = 0;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="product_discount_id", type="integer", nullable=true, options={"default" : 0})
	 */
	private $productDiscountId = 0;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="product_currency", type="integer", nullable=true, options={"default" : 0})
	 */
	private $productCurrency = 0;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="product_price_publish_up", type="datetime", nullable=false)
	 */
	private $productPricePublishUp;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="product_price_publish_down", type="datetime", nullable=false)
	 */
	private $productPricePublishDown;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="price_quantity_start", type="integer", nullable=false, options={"default" : 0})
	 */
	private $priceQuantityStart = 0;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="price_quantity_end", type="integer", nullable=false, options={"default" : 0})
	 */
	private $priceQuantityEnd = 0;


	/**
	 * @return int
	 */
	public function getShopperGroupId(): int
	{
		return $this->shopperGroupId;
	}

	/**
	 * @param int $shopperGroupId
	 */
	public function setShopperGroupId(int $shopperGroupId): void
	{
		$this->shopperGroupId = $shopperGroupId;
	}

	/**
	 * @return mixed
	 */
	public function getProductPrice()
	{
		return $this->productPrice;
	}

	/**
	 * @param mixed $productPrice
	 */
	public function setProductPrice($productPrice): void
	{
		$this->productPrice = $productPrice;
	}


	/**
	 * @return bool|null
	 */
	public function getOverride(): ?bool
	{
		return $this->override;
	}

	/**
	 * @param bool|null $override
	 */
	public function setOverride(?bool $override): void
	{
		$this->override = $override;
	}

	/**
	 * @return null
	 */
	public function getProductOverridePrice()
	{
		return $this->productOverridePrice;
	}

	/**
	 * @param null $productOverridePrice
	 */
	public function setProductOverridePrice($productOverridePrice): void
	{
		$this->productOverridePrice = $productOverridePrice;
	}

	/**
	 * @return int|null
	 */
	public function getProductTaxId(): ?int
	{
		return $this->productTaxId;
	}

	/**
	 * @param int|null $productTaxId
	 */
	public function setProductTaxId(?int $productTaxId): void
	{
		$this->productTaxId = $productTaxId;
	}

	/**
	 * @return int|null
	 */
	public function getProductDiscountId(): ?int
	{
		return $this->productDiscountId;
	}

	/**
	 * @param int|null $productDiscountId
	 */
	public function setProductDiscountId(?int $productDiscountId): void
	{
		$this->productDiscountId = $productDiscountId;
	}

	/**
	 * @return int|null
	 */
	public function getProductCurrency(): ?int
	{
		return $this->productCurrency;
	}

	/**
	 * @param int|null $productCurrency
	 */
	public function setProductCurrency(?int $productCurrency): void
	{
		$this->productCurrency = $productCurrency;
	}

	/**
	 * @return DateTime
	 */
	public function getProductPricePublishUp(): DateTime
	{
		return $this->productPricePublishUp;
	}

	/**
	 * @param DateTime $productPricePublishUp
	 */
	public function setProductPricePublishUp(DateTime $productPricePublishUp): void
	{
		$this->productPricePublishUp = $productPricePublishUp;
	}

	/**
	 * @return DateTime
	 */
	public function getProductPricePublishDown(): DateTime
	{
		return $this->productPricePublishDown;
	}

	/**
	 * @param DateTime $productPricePublishDown
	 */
	public function setProductPricePublishDown(DateTime $productPricePublishDown): void
	{
		$this->productPricePublishDown = $productPricePublishDown;
	}

	/**
	 * @return int
	 */
	public function getPriceQuantityStart(): int
	{
		return $this->priceQuantityStart;
	}

	/**
	 * @param int $priceQuantityStart
	 */
	public function setPriceQuantityStart(int $priceQuantityStart): void
	{
		$this->priceQuantityStart = $priceQuantityStart;
	}

	/**
	 * @return int
	 */
	public function getPriceQuantityEnd(): int
	{
		return $this->priceQuantityEnd;
	}

	/**
	 * @param int $priceQuantityEnd
	 */
	public function setPriceQuantityEnd(int $priceQuantityEnd): void
	{
		$this->priceQuantityEnd = $priceQuantityEnd;
	}
}





