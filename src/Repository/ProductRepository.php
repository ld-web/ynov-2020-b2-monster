<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Product::class);
  }

  /**
   * Retrieves top number of products
   *
   * @param integer $number
   * @return Product[] Top products
   */
  public function top(int $number)
  {
    $qb = $this->createQueryBuilder('p')
      ->where('p.visible = :isVisible')
      ->setParameter('isVisible', true)
      ->orderBy('p.created', 'DESC')
      ->setMaxResults($number);

    return $qb->getQuery()->getResult();
  }
}
