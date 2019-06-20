<?php

namespace App\Domain\Model\SearchHistory;

/**
 * Interface SearchHistoryRepositoryInterface
 * @package App\Domain\Model\SearchHistory
 */
interface SearchHistoryRepositoryInterface
{

    /**
     * @param int $searchHistoryId
     * @return SearchHistory
     */
    public function findById(int $searchHistoryId): ?SearchHistory;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param SearchHistory $searchHistory
     */
    public function save(SearchHistory $searchHistory): void;

    /**
     * @param SearchHistory $searchHistory
     */
    public function delete(SearchHistory $searchHistory): void;

}
