<?php

namespace App\Repository;

use App\Entity\Sponsor;
use Doctrine\ORM\EntityManagerInterface;

class SponsorRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Sponsor[]
     */
    public function findAll(): iterable
    {
        return $this->entityManager->getRepository(Sponsor::class)->findAll();
    }

    public function persist(Sponsor $sponsor): void
    {
        $this->entityManager->persist($sponsor);
        $this->entityManager->flush();
    }
}
