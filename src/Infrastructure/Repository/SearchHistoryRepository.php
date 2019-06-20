<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\SearchHistory\SearchHistory;
use App\Domain\Model\SearchHistory\SearchHistoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class SearchHistoryRepository
 * @package App\Infrastructure\Repository
 */
final class SearchHistoryRepository implements SearchHistoryRepositoryInterface
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
     * SearchHistoryRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(SearchHistory::class);
    }

    /**
     * @param int $searchHistoryId
     * @return SearchHistory
     */
    public function findById(int $searchHistoryId): ?SearchHistory
    {
        return $this->objectRepository->find($searchHistoryId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param SearchHistory $searchHistory
     */
    public function save(SearchHistory $searchHistory): void
    {
        $this->entityManager->persist($searchHistory);
        $this->entityManager->flush();
    }

    /**
     * @param SearchHistory $searchHistory
     */
    public function delete(SearchHistory $searchHistory): void
    {
        $this->entityManager->remove($searchHistory);
        $this->entityManager->flush();
    }

}
