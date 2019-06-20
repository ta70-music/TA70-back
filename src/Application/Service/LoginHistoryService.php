<?php

namespace App\Application\Service;


use App\Application\DTO\LoginHistoryAssembler;
use App\Application\DTO\LoginHistoryDTO;
use App\Domain\Model\LoginHistory\LoginHistory;
use App\Domain\Model\LoginHistory\LoginHistoryRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class LoginHistoryService
 * @package App\Application\Service
 */
final class LoginHistoryService
{

    /**
     * @var LoginHistoryRepositoryInterface
     */
    private $loginHistoryRepository;

    /**
     * @var LoginHistoryAssembler
     */
    private $loginHistoryAssembler;

    /**
     * LoginHistoryService constructor.
     * @param LoginHistoryRepositoryInterface $loginHistoryRepository
     * @param LoginHistoryAssembler $loginHistoryAssembler
     */
    public function __construct(
        LoginHistoryRepositoryInterface $loginHistoryRepository,
        LoginHistoryAssembler $loginHistoryAssembler
    ) {
        $this->loginHistoryRepository = $loginHistoryRepository;
        $this->loginHistoryAssembler = $loginHistoryAssembler;
    }

    /**
     * @param int $loginHistoryId
     * @return LoginHistory
     * @throws EntityNotFoundException
     */
    public function getLoginHistory(int $loginHistoryId): LoginHistory
    {
        $loginHistory = $this->loginHistoryRepository->findById($loginHistoryId);
        if (!$loginHistory) {
            throw new EntityNotFoundException('LoginHistory with id '.$loginHistoryId.' does not exist!');
        }
        return $loginHistory;
    }

    /**
     * @return array|null
     */
    public function getAllLoginHistorys(): ?array
    {
        return $this->loginHistoryRepository->findAll();
    }

    /**
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return LoginHistory
     */
    public function addLoginHistory(LoginHistoryDTO $loginHistoryDTO): LoginHistory
    {
        $loginHistory = $this->loginHistoryAssembler->createLoginHistory($loginHistoryDTO);
        $this->loginHistoryRepository->save($loginHistory);

        return $loginHistory;
    }

    /**
     * @param int $loginHistoryId
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return LoginHistory
     * @throws EntityNotFoundException
     */
    public function updateLoginHistory(int $loginHistoryId, LoginHistoryDTO $loginHistoryDTO): LoginHistory
    {
        $loginHistory = $this->loginHistoryRepository->findById($loginHistoryId);
        if (!$loginHistory) {
            throw new EntityNotFoundException('LoginHistory with id '.$loginHistoryId.' does not exist!');
        }
        $loginHistory = $this->loginHistoryAssembler->updateLoginHistory($loginHistory, $loginHistoryDTO);
        $this->loginHistoryRepository->save($loginHistory);

        return $loginHistory;
    }

    /**
     * @param int $loginHistoryId
     * @throws EntityNotFoundException
     */
    public function deleteLoginHistory(int $loginHistoryId): void
    {
        $loginHistory = $this->loginHistoryRepository->findById($loginHistoryId);
        if (!$loginHistory) {
            throw new EntityNotFoundException('LoginHistory with id '.$loginHistoryId.' does not exist!');
        }

        $this->loginHistoryRepository->delete($loginHistory);
    }

}
