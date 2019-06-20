<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\ListenHistoryDTO;
use App\Application\Service\ListenHistoryService;
use App\Domain\Model\ListenHistory\ListenHistory;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListenHistoryController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class ListenHistoryController extends FOSRestController
{
    /**
     * @var ListenHistoryService
     */
    private $listenHistoryService;

    /**
     * ListenHistoryController constructor.
     * @param ListenHistoryService $listenHistoryService
     */
    public function __construct(ListenHistoryService $listenHistoryService)
    {
        $this->listenHistoryService = $listenHistoryService;
    }

    /**
     * Creates an ListenHistory resource
     * @Rest\Post("/listenHistorys")
     * @ParamConverter("listenHistoryDTO", converter="fos_rest.request_body")
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return View
     */
    public function postListenHistory(ListenHistoryDTO $listenHistoryDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            //TODO Check User
        $listenHistory = $this->listenHistoryService->addListenHistory($listenHistoryDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($listenHistory, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an ListenHistory resource
     * @Rest\Get("/listenHistorys/{listenHistoryId}")
     * @param int $listenHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getListenHistory(int $listenHistoryId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $listenHistory = $this->listenHistoryService->getListenHistory($listenHistoryId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($listenHistory, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of ListenHistory resource
     * @Rest\Get("/listenHistorys")
     * @return View
     */
    public function getListenHistorys(): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $listenHistorys = $this->listenHistoryService->getAllListenHistorys();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of listenHistory object
        return View::create($listenHistorys, Response::HTTP_OK);
    }

    /**
     * Replaces ListenHistory resource
     * @Rest\Put("/listenHistorys/{id}")
     * @ParamConverter("listenHistoryDTO", converter="fos_rest.request_body")
     * @param int $listenHistoryId
     * @param ListenHistoryDTO $listenHistoryDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putListenHistory(int $listenHistoryId, ListenHistoryDTO $listenHistoryDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $listenHistory = $this->listenHistoryService->updateListenHistory($listenHistoryId, $listenHistoryDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($listenHistory, Response::HTTP_OK);
    }

    /**
     * Removes the ListenHistory resource
     * @Rest\Delete("/listenHistorys/{listenHistoryId}")
     * @param int $listenHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteListenHistory(int $listenHistoryId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $this->listenHistoryService->deleteListenHistory($listenHistoryId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
