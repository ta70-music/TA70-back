<?php


namespace App\Application\DTO;


use App\Domain\Model\ListenHistory\ListenHistory;

/**
 * Class ListenHistoryAssembler
 * @package App\Application\DTO
 */
final class ListenHistoryAssembler
{

    /**
     * @param ListenHistoryDTO $listenHistoryDTO
     * @param ListenHistory|null $listenHistory
     * @return ListenHistory
     */
    public function readDTO(ListenHistoryDTO $listenHistoryDTO, ?ListenHistory $listenHistory = null): ListenHistory
    {
        if (!$listenHistory) {
            $listenHistory = new ListenHistory();
        }

        $listenHistory->setContent($listenHistoryDTO->getContent());
        $listenHistory->setTitle($listenHistoryDTO->getTitle());

        return $listenHistory;
    }

    /**
     * @param ListenHistory $listenHistory
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return ListenHistory
     */
    public function updateListenHistory(ListenHistory $listenHistory, ListenHistoryDTO $listenHistoryDTO): ListenHistory
    {
        return $this->readDTO($listenHistoryDTO, $listenHistory);
    }

    /**
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return ListenHistory
     */
    public function createListenHistory(ListenHistoryDTO $listenHistoryDTO): ListenHistory
    {
        return $this->readDTO($listenHistoryDTO);
    }

    /**
     * @param ListenHistory $listenHistory
     * @return ListenHistoryDTO
     */
    public function writeDTO(ListenHistory $listenHistory)
    {
        return new ListenHistoryDTO(
            $listenHistory->getTitle(),
            $listenHistory->getContent()
        );
    }

}
