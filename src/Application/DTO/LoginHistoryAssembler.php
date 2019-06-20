<?php


namespace App\Application\DTO;


use App\Domain\Model\LoginHistory\LoginHistory;

/**
 * Class LoginHistoryAssembler
 * @package App\Application\DTO
 */
final class LoginHistoryAssembler
{

    /**
     * @param LoginHistoryDTO $loginHistoryDTO
     * @param LoginHistory|null $loginHistory
     * @return LoginHistory
     */
    public function readDTO(LoginHistoryDTO $loginHistoryDTO, ?LoginHistory $loginHistory = null): LoginHistory
    {
        if (!$loginHistory) {
            $loginHistory = new LoginHistory();
        }

        $loginHistory->setContent($loginHistoryDTO->getContent());
        $loginHistory->setTitle($loginHistoryDTO->getTitle());

        return $loginHistory;
    }

    /**
     * @param LoginHistory $loginHistory
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return LoginHistory
     */
    public function updateLoginHistory(LoginHistory $loginHistory, LoginHistoryDTO $loginHistoryDTO): LoginHistory
    {
        return $this->readDTO($loginHistoryDTO, $loginHistory);
    }

    /**
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return LoginHistory
     */
    public function createLoginHistory(LoginHistoryDTO $loginHistoryDTO): LoginHistory
    {
        return $this->readDTO($loginHistoryDTO);
    }

    /**
     * @param LoginHistory $loginHistory
     * @return LoginHistoryDTO
     */
    public function writeDTO(LoginHistory $loginHistory)
    {
        return new LoginHistoryDTO(
            $loginHistory->getTitle(),
            $loginHistory->getContent()
        );
    }

}
