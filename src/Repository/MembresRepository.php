<?php

namespace App\Repository;

use App\Entity\Membres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Membres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membres[]    findAll()
 * @method Membres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membres::class);
    }

    public function getMembersInactives(): array{

        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM membres WHERE id_soiree IS NULL";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
}
