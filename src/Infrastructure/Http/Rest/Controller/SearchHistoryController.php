<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\SearchHistoryDTO;
use App\Application\Service\SearchHistoryService;
use App\Domain\Model\SearchHistory\SearchHistory;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SearchHistoryController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class SearchHistoryController extends FOSRestController
{
    /**
     * @var SearchHistoryService
     */
    private $searchHistoryService;

    /**
     * SearchHistoryController constructor.
     * @param SearchHistoryService $searchHistoryService
     */
    public function __construct(SearchHistoryService $searchHistoryService)
    {
        $this->searchHistoryService = $searchHistoryService;
    }

    /**
     * Creates an SearchHistory resource
     * @Rest\Post("/searchHistorys")
     * @ParamConverter("searchHistoryDTO", converter="fos_rest.request_body")
     * @param SearchHistoryDTO $searchHistoryDTO
     * @return View
     */
    public function postSearchHistory(SearchHistoryDTO $searchHistoryDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $searchHistory = $this->searchHistoryService->addSearchHistory($searchHistoryDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($searchHistory, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an SearchHistory resource
     * @Rest\Get("/searchHistorys/{searchHistoryId}")
     * @param int $searchHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getSearchHistory(int $searchHistoryId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $searchHistory = $this->searchHistoryService->getSearchHistory($searchHistoryId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($searchHistory, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of SearchHistory resource
     * @Rest\Get("/searchHistorys")
     * @return View
     */
    public function getSearchHistorys(): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $searchHistorys = $this->searchHistoryService->getAllSearchHistorys();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of searchHistory object
        return View::create($searchHistorys, Response::HTTP_OK);
    }


    /**
     * Removes the SearchHistory resource
     * @Rest\Delete("/searchHistorys/{searchHistoryId}")
     * @param int $searchHistoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteSearchHistory(int $searchHistoryId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $this->searchHistoryService->deleteSearchHistory($searchHistoryId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
