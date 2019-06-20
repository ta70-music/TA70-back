<?php

namespace App\Domain\Model\LoginHistory;

/**
 * Interface LoginHistoryRepositoryInterface
 * @package App\Domain\Model\LoginHistory
 */
interface LoginHistoryRepositoryInterface
{

    /**
     * @param int $loginHistoryId
     * @return LoginHistory
     */
    public function findById(int $loginHistoryId): ?LoginHistory;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param LoginHistory $loginHistory
     */
    public function save(LoginHistory $loginHistory): void;

    /**
     * @param LoginHistory $loginHistory
     */
    public function delete(LoginHistory $loginHistory): void;

}
