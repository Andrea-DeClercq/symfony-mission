<?php

namespace App\Repository;

use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reponse>
 *
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function add(Reponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function showReponse(int $id)
    {
        
        $qb = $this->createQueryBuilder('p');
            //$qb->select(array('rep'))
            //->from('Reponse','rep')
            $qb->andWhere('p.idQuestion = '.$id.'')
            ->orderBy('p.date', 'DESC')
            ->getQuery()
            ->getResult();
                
        return $qb;

    }
    //Fonction qui récupère toute les réponses lié à l'id de la question
    public function getAllReponse(int $id): array
    {
        return $this->createQueryBuilder('reponse')
            ->andWhere('reponse.idQuestion = :rid')
            ->setParameter('rid', $id)
            ->orderBy('reponse.date','ASC')
            ->setMaxResults(1000)   //set sur 1000 afin d'avoir un maximum de réponses car sans cette fonction se limite à 1 réponse
            ->getQuery()
            ->getArrayResult();
    }

    //Fonction  permettant de compter le nombre de réponse en fonction de l'id de la question 
    public function nbr(ManagerRegistry $doctrine,int $id){
        //$id=2;
        $em = $doctrine->getManager();
        $repoRep = $em->getRepository(Reponse::class);

        $totalRep = $repoRep->createQueryBuilder('a')
            ->where('a.idQuestion = '.$id.'')
            ->select('count(a.idQuestion)')
            ->getQuery()
            ->getSingleScalarResult();
        //dd($totalRep)
        return $totalRep;
    }
    

//    /**
//     * @return Reponse[] Returns an array of Reponse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reponse
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
