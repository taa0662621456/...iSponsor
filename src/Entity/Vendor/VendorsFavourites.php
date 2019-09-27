<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\EntitySystemTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_favourites")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 */
class VendorsFavourites
{
	use EntitySystemTrait;

    /**
	 * @var int
	 *
	 * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\VendorsFavourites", inversedBy="vendorFavourites")
	 * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id")
	 */
    private $vendorFavourites = 0;


	/**
	 * @return int
	 */
	public function getVendorFavourites(): int
	{
		return $this->vendorFavourites;
	}

	/**
	 * @param int $vendorFavourites
	 */
	public function setVendorFavourites(int $vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
	}
}
