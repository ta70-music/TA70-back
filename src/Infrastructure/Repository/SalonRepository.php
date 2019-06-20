<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Salon\Salon;
use App\Domain\Model\Salon\SalonRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class SalonRepository
 * @package App\Infrastructure\Repository
 */
final class SalonRepository implements SalonRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * SalonRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Salon::class);
    }

    /**
     * @param int $salonId
     * @return Salon
     */
    public function findById(int $salonId): ?Salon
    {
        return $this->objectRepository->find($salonId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Salon $salon
     */
    public function save(Salon $salon): void
    {
        $this->entityManager->persist($salon);
        $this->entityManager->flush();
    }

    /**
     * @param Salon $salon
     */
    public function delete(Salon $salon): void
    {
        $this->entityManager->remove($salon);
        $this->entityManager->flush();
    }
}
