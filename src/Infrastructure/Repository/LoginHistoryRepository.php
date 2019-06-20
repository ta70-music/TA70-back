<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\LoginHistory\LoginHistory;
use App\Domain\Model\LoginHistory\LoginHistoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
* Class LoginHistoryRepository
 * @package App\Infrastructure\Repository
*/
final class LoginHistoryRepository implements LoginHistoryRepositoryInterface
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
     * LoginHistoryRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(LoginHistory::class);
    }

    /**
     * @param int $loginHistoryId
     * @return LoginHistory
     */
    public function findById(int $loginHistoryId): ?LoginHistory
    {
        return $this->objectRepository->find($loginHistoryId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param LoginHistory $loginHistory
     */
    public function save(LoginHistory $loginHistory): void
    {
        $this->entityManager->persist($loginHistory);
        $this->entityManager->flush();
    }

    /**
     * @param LoginHistory $loginHistory
     */
    public function delete(LoginHistory $loginHistory): void
    {
        $this->entityManager->remove($loginHistory);
        $this->entityManager->flush();
    }
}
