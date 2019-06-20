<?php

namespace App\Application\Service;


use App\Application\DTO\ListenHistoryAssembler;
use App\Application\DTO\ListenHistoryDTO;
use App\Domain\Model\ListenHistory\ListenHistory;
use App\Domain\Model\ListenHistory\ListenHistoryRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class ListenHistoryService
 * @package App\Application\Service
 */
final class ListenHistoryService
{

    /**
     * @var ListenHistoryRepositoryInterface
     */
    private $listenHistoryRepository;

    /**
     * @var ListenHistoryAssembler
     */
    private $listenHistoryAssembler;

    /**
     * ListenHistoryService constructor.
     * @param ListenHistoryRepositoryInterface $listenHistoryRepository
     * @param ListenHistoryAssembler $listenHistoryAssembler
     */
    public function __construct(
        ListenHistoryRepositoryInterface $listenHistoryRepository,
        ListenHistoryAssembler $listenHistoryAssembler
    ) {
        $this->listenHistoryRepository = $listenHistoryRepository;
        $this->listenHistoryAssembler = $listenHistoryAssembler;
    }

    /**
     * @param int $listenHistoryId
     * @return ListenHistory
     * @throws EntityNotFoundException
     */
    public function getListenHistory(int $listenHistoryId): ListenHistory
    {
        $listenHistory = $this->listenHistoryRepository->findById($listenHistoryId);
        if (!$listenHistory) {
            throw new EntityNotFoundException('ListenHistory with id '.$listenHistoryId.' does not exist!');
        }
        return $listenHistory;
    }

    /**
     * @return array|null
     */
    public function getAllListenHistorys(): ?array
    {
        return $this->listenHistoryRepository->findAll();
    }

    /**
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return ListenHistory
     */
    public function addListenHistory(ListenHistoryDTO $listenHistoryDTO): ListenHistory
    {
        $listenHistory = $this->listenHistoryAssembler->createListenHistory($listenHistoryDTO);
        $this->listenHistoryRepository->save($listenHistory);

        return $listenHistory;
    }

    /**
     * @param int $listenHistoryId
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return ListenHistory
     * @throws EntityNotFoundException
     */
    public function updateListenHistory(int $listenHistoryId, ListenHistoryDTO $listenHistoryDTO): ListenHistory
    {
        $listenHistory = $this->listenHistoryRepository->findById($listenHistoryId);
        if (!$listenHistory) {
            throw new EntityNotFoundException('ListenHistory with id '.$listenHistoryId.' does not exist!');
        }
        $listenHistory = $this->listenHistoryAssembler->updateListenHistory($listenHistory, $listenHistoryDTO);
        $this->listenHistoryRepository->save($listenHistory);

        return $listenHistory;
    }

    /**
     * @param int $listenHistoryId
     * @throws EntityNotFoundException
     */
    public function deleteListenHistory(int $listenHistoryId): void
    {
        $listenHistory = $this->listenHistoryRepository->findById($listenHistoryId);
        if (!$listenHistory) {
            throw new EntityNotFoundException('ListenHistory with id '.$listenHistoryId.' does not exist!');
        }

        $this->listenHistoryRepository->delete($listenHistory);
    }

}
