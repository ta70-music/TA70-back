<?php

namespace App\Application\Service;


use App\Application\DTO\UserAssembler;
use App\Application\DTO\UserDTO;
use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class UserService
 * @package App\Application\Service
 */
final class UserService
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserAssembler
     */
    private $userAssembler;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserAssembler $userAssembler
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserAssembler $userAssembler
    ) {
        $this->userRepository = $userRepository;
        $this->userAssembler = $userAssembler;
    }

    /**
     * @param int $userId
     * @return User
     * @throws EntityNotFoundException
     */
    public function getUser(int $userId): User
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw new EntityNotFoundException('User with id '.$userId.' does not exist!');
        }
        return $user;
    }

    /**
     * @return array|null
     */
    public function getAllUsers(): ?array
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function addUser(UserDTO $userDTO): User
    {
        $user = $this->userAssembler->createUser($userDTO);
        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @param int $userId
     * @param UserDTO $userDTO
     * @return User
     * @throws EntityNotFoundException
     */
    public function updateUser(int $userId, UserDTO $userDTO): User
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw new EntityNotFoundException('User with id '.$userId.' does not exist!');
        }
        $user = $this->userAssembler->updateUser($user, $userDTO);
        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @param int $userId
     * @throws EntityNotFoundException
     */
    public function deleteUser(int $userId): void
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw new EntityNotFoundException('User with id '.$userId.' does not exist!');
        }

        $this->userRepository->delete($user);
    }

}
