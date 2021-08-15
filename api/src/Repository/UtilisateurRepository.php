<?php

namespace App\Repository;

use App\Entity\ApiToken;
use App\Entity\Utilisateur;
use Aroban\Bundle\UtilisateurBundle\Repository\ArobanUtilisateurRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository implements ArobanUtilisateurRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function fetchByToken(string $token): ?Utilisateur
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->join(ApiToken::class, 'at', Join::WITH, 'at.utilisateur = u')
            ->andWhere('at.token = :token')
            ->andWhere('at.expiresAt >= :expiresAt')
            ->setParameter('token', $token)
            ->setParameter('expiresAt', new \DateTime())
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
