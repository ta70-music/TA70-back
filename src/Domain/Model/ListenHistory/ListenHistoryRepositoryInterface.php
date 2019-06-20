<?php

namespace App\Domain\Model\ListenHistory;

/**
 * Interface ListenHistoryRepositoryInterface
 * @package App\Domain\Model\ListenHistory
 */
interface ListenHistoryRepositoryInterface
{

    /**
     * @param int $listenHistoryId
     * @return ListenHistory
     */
    public function findById(int $listenHistoryId): ?ListenHistory;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param ListenHistory $listenHistory
     */
    public function save(ListenHistory $listenHistory): void;

    /**
     * @param ListenHistory $listenHistory
     */
    public function delete(ListenHistory $listenHistory): void;

}
