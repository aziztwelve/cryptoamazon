<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @extends ServiceEntityRepository<Product>
 *
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

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByFilter(
        ?int $categoryId,
        ?int $manufacturerId,
        array $price,
    ): array {
        $query = $this->createQueryBuilder('p');

        if ($categoryId) {
            $query->innerJoin(join: 'p.categories', alias: 'c', conditionType: Expr\Join::WITH, condition: "c.id = :categoryId");
            $query->setParameter('categoryId',  $categoryId);
        }

        if ($manufacturerId) {
            $query->innerJoin(join: 'p.manufacturer', alias: 'm', conditionType: Expr\Join::WITH, condition: "m.id = :manufacturerId");
            $query->setParameter('manufacturerId',  $manufacturerId);
        }

        if (!empty($price)) {
            $query->andWhere('p.price BETWEEN :from AND :to')
                ->setParameter('from', $price['from'])
                ->setParameter('to', $price['to']);
        }

        return $query
            ->getQuery()
            ->getResult();
    }
}
