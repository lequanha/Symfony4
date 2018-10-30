<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

//    /**
//     * @return Category[] Returns an array of Category objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function transform(Category $category)
    {
        return [
           'id'    => (int) $category->getId(),
           'name'  => (string) $category->getName(),
           'created_at' => (string) ($category->getCreatedAt() ? $category->getCreatedAt()->format('Y-m-d H:i:s') : NULL),
           'modified_at' => (string) ($category->getModifiedAt() ? $category->getModifiedAt()->format('Y-m-d H:i:s') : NULL)
        ];
    }

    public function transformAll()
    {
        $categories = $this->findAll();
        $categoriesArray = [];

        foreach ($categories as $category) {
            $categoriesArray[] = $this->transform($category);
        }

        return $categoriesArray;
    }
}
