<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\ListenHistory\ListenHistory;
use App\Domain\Model\ListenHistory\ListenHistoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ListenHistoryRepository
 * @package App\Infrastructure\Repository
 */
final class ListenHistoryRepository implements ListenHistoryRepositoryInterface
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
     * ListenHistoryRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(ListenHistory::class);
    }

    /**
     * @param int $listenHistoryId
     * @return ListenHistory
     */
    public function findById(int $listenHistoryId): ?ListenHistory
    {
        return $this->objectRepository->find($listenHistoryId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param ListenHistory $listenHistory
     */
    public function save(ListenHistory $listenHistory): void
    {
        $this->entityManager->persist($listenHistory);
        $this->entityManager->flush();
    }

    /**
     * @param ListenHistory $listenHistory
     */
    public function delete(ListenHistory $listenHistory): void
    {
        $this->entityManager->remove($listenHistory);
        $this->entityManager->flush();
    }
}
