<?php


namespace App\Application\DTO;


use App\Domain\Model\User\User;

/**
 * Class UserAssembler
 * @package App\Application\DTO
 */
final class UserAssembler
{

    /**
     * @param UserDTO $userDTO
     * @param User|null $user
     * @return User
     */
    public function readDTO(UserDTO $userDTO, ?User $user = null): User
    {
        if (!$user) {
            $user = new User();
        }

        $user->setLastname($userDTO->getLastname());
        $user->setFirstname($userDTO->getFirstname());
        $user->setEmail($userDTO->getEmail());
        $user->setPassword($userDTO->getPassword());
        $user->setImage($userDTO->getImage());
        $user->setRoles($userDTO->getRoles());
        $user->addUser($userDTO->getUser());
        $user->addLoginHistory($userDTO->getLoginHistory());
        $user->addMessage($userDTO->getMessage());
        $user->addSalon($userDTO->getSalon());
        $user->addListenHistory($userDTO->getListenHistory());
        $user->addSearchHistory($userDTO->getSearchHistory());
        $user->addMusic($userDTO->getMusic());

        return $user;
    }

    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return User
     */
    public function updateUser(User $user, UserDTO $userDTO): User
    {
        return $this->readDTO($userDTO, $user);
    }

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function createUser(UserDTO $userDTO): User
    {
        return $this->readDTO($userDTO);
    }

    /**
     * @param User $user
     * @return UserDTO
     */
    public function writeDTO(User $user)
    {
        return new UserDTO(
            $user->getTitle(),
            $user->getContent()
        );
    }

}
