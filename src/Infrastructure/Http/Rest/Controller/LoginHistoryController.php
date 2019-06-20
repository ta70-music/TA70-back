<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\LoginHistoryDTO;
use App\Application\Service\LoginHistoryService;
use App\Domain\Model\LoginHistory\LoginHistory;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginHistoryController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class LoginHistoryController extends FOSRestController
{
    /**
     * @var LoginHistoryService
     */
    private $loginHistoryService;

    /**
     * LoginHistoryController constructor.
     * @param LoginHistoryService $loginHistoryService
     */
    public function __construct(LoginHistoryService $loginHistoryService)
    {
        $this->loginHistoryService = $loginHistoryService;
    }

    /**
     * Creates an LoginHistory resource
     * @Rest\Post("/loginHistorys")
     * @ParamConverter("loginHistoryDTO", converter="fos_rest.request_body")
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return View
     */
    public function postLoginHistory(LoginHistoryDTO $loginHistoryDTO): View
    {
        $loginHistory = $this->loginHistoryService->addLoginHistory($loginHistoryDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($loginHistory, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an LoginHistory resource
     * @Rest\Get("/loginHistorys/{loginHistoryId}")
     * @param int $loginHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getLoginHistory(int $loginHistoryId): View
    {
        $loginHistory = $this->loginHistoryService->getLoginHistory($loginHistoryId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($loginHistory, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of LoginHistory resource
     * @Rest\Get("/loginHistorys")
     * @return View
     */
    public function getLoginHistorys(): View
    {
        $loginHistorys = $this->loginHistoryService->getAllLoginHistorys();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of loginHistory object
        return View::create($loginHistorys, Response::HTTP_OK);
    }

    /**
     * Replaces LoginHistory resource
     * @Rest\Put("/loginHistorys/{id}")
     * @ParamConverter("loginHistoryDTO", converter="fos_rest.request_body")
     * @param int $loginHistoryId
     * @param LoginHistoryDTO $loginHistoryDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putLoginHistory(int $loginHistoryId, LoginHistoryDTO $loginHistoryDTO): View
    {
        $loginHistory = $this->loginHistoryService->updateLoginHistory($loginHistoryId, $loginHistoryDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($loginHistory, Response::HTTP_OK);
    }

    /**
     * Removes the LoginHistory resource
     * @Rest\Delete("/loginHistorys/{loginHistoryId}")
     * @param int $loginHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteLoginHistory(int $loginHistoryId): View
    {
        $this->loginHistoryService->deleteLoginHistory($loginHistoryId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
