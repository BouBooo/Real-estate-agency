<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
	 * @return QueryBuilder
	 */
	public function findVisibleBien(): QueryBuilder
	{
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
	}

    public function findAllVisibleQuery(PropertySearch $search): Query
    {
        $query = $this->findVisibleBien();

        if($search->getMaxPrice())
        {
            $query = $query
                    ->andWhere('p.price <= :maxprice')
                    ->setParameter('maxprice', $search->getMaxPrice());
        }

        if($search->getMinSurface())
        {
            $query = $query
                    ->andWhere('p.surface >= :minsurface')
                    ->setParameter('minsurface', $search->getMinSurface());
        }

        if($search->getNbrBedrooms())
        {
            $query = $query
                    ->andWhere('p.bedrooms >= :nbrbedrooms')
                    ->setParameter('nbrbedrooms', $search->getNbrBedrooms());
        }

        if($search->getNbrRooms())
        {
            $query = $query
                    ->andWhere('p.rooms >= :nbrrooms')
                    ->setParameter('nbrrooms', $search->getNbrRooms());
        }

        /*if($search->getOptions()->count() > 0)
        {
            foreach($search->getOptions() as $option)
            {
                $query = $query
                        ->andWhere(":option MEMBER OF p.options")
                        ->setParameter("option", $option);
            }
        }*/


        return $query->getQuery();
  
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;      
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
