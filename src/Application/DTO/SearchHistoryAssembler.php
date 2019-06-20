<?php


namespace App\Application\DTO;


use App\Domain\Model\SearchHistory\SearchHistory;

/**
 * Class SearchHistoryAssembler
 * @package App\Application\DTO
 */
final class SearchHistoryAssembler
{

    /**
     * @param SearchHistoryDTO $searchHistoryDTO
     * @param SearchHistory|null $searchHistory
     * @return SearchHistory
     */
    public function readDTO(SearchHistoryDTO $searchHistoryDTO, ?SearchHistory $searchHistory = null): SearchHistory
    {
        if (!$searchHistory) {
            $searchHistory = new SearchHistory();
        }

        $searchHistory->setContent($searchHistoryDTO->getContent());
        $searchHistory->setTitle($searchHistoryDTO->getTitle());

        return $searchHistory;
    }

    /**
     * @param SearchHistory $searchHistory
     * @param SearchHistoryDTO $searchHistoryDTO
     * @return SearchHistory
     */
    public function updateSearchHistory(SearchHistory $searchHistory, SearchHistoryDTO $searchHistoryDTO): SearchHistory
    {
        return $this->readDTO($searchHistoryDTO, $searchHistory);
    }

    /**
     * @param SearchHistoryDTO $searchHistoryDTO
     * @return SearchHistory
     */
    public function createSearchHistory(SearchHistoryDTO $searchHistoryDTO): SearchHistory
    {
        return $this->readDTO($searchHistoryDTO);
    }

    /**
     * @param SearchHistory $searchHistory
     * @return SearchHistoryDTO
     */
    public function writeDTO(SearchHistory $searchHistory)
    {
        return new SearchHistoryDTO(
            $searchHistory->getTitle(),
            $searchHistory->getContent()
        );
    }

}
