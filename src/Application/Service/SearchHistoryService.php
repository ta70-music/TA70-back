<?php

namespace App\Application\Service;


use App\Application\DTO\SearchHistoryAssembler;
use App\Application\DTO\SearchHistoryDTO;
use App\Domain\Model\SearchHistory\SearchHistory;
use App\Domain\Model\SearchHistory\SearchHistoryRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class SearchHistoryService
 * @package App\Application\Service
 */
final class SearchHistoryService
{

    /**
     * @var SearchHistoryRepositoryInterface
     */
    private $searchHistoryRepository;

    /**
     * @var SearchHistoryAssembler
     */
    private $searchHistoryAssembler;

    /**
     * SearchHistoryService constructor.
     * @param SearchHistoryRepositoryInterface $searchHistoryRepository
     * @param SearchHistoryAssembler $searchHistoryAssembler
     */
    public function __construct(
        SearchHistoryRepositoryInterface $searchHistoryRepository,
        SearchHistoryAssembler $searchHistoryAssembler
    ) {
        $this->searchHistoryRepository = $searchHistoryRepository;
        $this->searchHistoryAssembler = $searchHistoryAssembler;
    }

    /**
     * @param int $searchHistoryId
     * @return SearchHistory
     * @throws EntityNotFoundException
     */
    public function getSearchHistory(int $searchHistoryId): SearchHistory
    {
        $searchHistory = $this->searchHistoryRepository->findById($searchHistoryId);
        if (!$searchHistory) {
            throw new EntityNotFoundException('SearchHistory with id '.$searchHistoryId.' does not exist!');
        }
        return $searchHistory;
    }

    /**
     * @return array|null
     */
    public function getAllSearchHistorys(): ?array
    {
        return $this->searchHistoryRepository->findAll();
    }

    /**
     * @param SearchHistoryDTO $searchHistoryDTO
     * @return SearchHistory
     */
    public function addSearchHistory(SearchHistoryDTO $searchHistoryDTO): SearchHistory
    {
        $searchHistory = $this->searchHistoryAssembler->createSearchHistory($searchHistoryDTO);
        $this->searchHistoryRepository->save($searchHistory);

        return $searchHistory;
    }

    /**
     * @param int $searchHistoryId
     * @param SearchHistoryDTO $searchHistoryDTO
     * @return SearchHistory
     * @throws EntityNotFoundException
     */
    public function updateSearchHistory(int $searchHistoryId, SearchHistoryDTO $searchHistoryDTO): SearchHistory
    {
        $searchHistory = $this->searchHistoryRepository->findById($searchHistoryId);
        if (!$searchHistory) {
            throw new EntityNotFoundException('SearchHistory with id '.$searchHistoryId.' does not exist!');
        }
        $searchHistory = $this->searchHistoryAssembler->updateSearchHistory($searchHistory, $searchHistoryDTO);
        $this->searchHistoryRepository->save($searchHistory);

        return $searchHistory;
    }

    /**
     * @param int $searchHistoryId
     * @throws EntityNotFoundException
     */
    public function deleteSearchHistory(int $searchHistoryId): void
    {
        $searchHistory = $this->searchHistoryRepository->findById($searchHistoryId);
        if (!$searchHistory) {
            throw new EntityNotFoundException('SearchHistory with id '.$searchHistoryId.' does not exist!');
        }

        $this->searchHistoryRepository->delete($searchHistory);
    }

}
