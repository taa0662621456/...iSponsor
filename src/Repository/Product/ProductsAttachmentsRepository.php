<?php
	declare(strict_types=1);

	namespace App\Repository\Product;


	use App\Entity\Product\ProductsAttachments;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method ProductsAttachments|null find($id, $lockMode = null, $lockVersion = null)
	 * @method ProductsAttachments|null findOneBy(array $criteria, array $orderBy = null)
	 * @method ProductsAttachments[]    findAll()
	 * @method ProductsAttachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class ProductsAttachmentsRepository extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, ProductsAttachments::class);
		}
	}
