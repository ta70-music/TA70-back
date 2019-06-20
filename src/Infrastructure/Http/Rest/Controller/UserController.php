<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\UserDTO;
use App\Application\Service\UserService;
use App\Domain\Model\User\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class UserController extends FOSRestController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Creates an User resource
     * @Rest\Post("/users")
     * @ParamConverter("userDTO", converter="fos_rest.request_body")
     * @param UserDTO $userDTO
     * @return View
     */
    public function postUser(UserDTO $userDTO): View
    {
        $user = $this->userService->addUser($userDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($user, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an User resource
     * @Rest\Get("/users/{userId}")
     * @param int $userId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getUser(int $userId): View
    {
        $user = $this->userService->getUser($userId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of User resource
     * @Rest\Get("/users")
     * @return View
     */
    public function getUsers(): View
    {
        $users = $this->userService->getAllUsers();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of user object
        return View::create($users, Response::HTTP_OK);
    }

    /**
     * Replaces User resource
     * @Rest\Put("/users/{id}")
     * @ParamConverter("userDTO", converter="fos_rest.request_body")
     * @param int $userId
     * @param UserDTO $userDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putUser(int $userId, UserDTO $userDTO): View
    {
        $user = $this->userService->updateUser($userId, $userDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Removes the User resource
     * @Rest\Delete("/users/{userId}")
     * @param int $userId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteUser(int $userId): View
    {
        $this->userService->deleteUser($userId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
