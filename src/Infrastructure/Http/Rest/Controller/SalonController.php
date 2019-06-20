<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\SalonDTO;
use App\Application\Service\SalonService;
use App\Domain\Model\Salon\Salon;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SalonController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class SalonController extends FOSRestController
{
    /**
     * @var SalonService
     */
    private $salonService;

    /**
     * SalonController constructor.
     * @param SalonService $salonService
     */
    public function __construct(SalonService $salonService)
    {
        $this->salonService = $salonService;
    }

    /**
     * Creates an Salon resource
     * @Rest\Post("/salons")
     * @ParamConverter("salonDTO", converter="fos_rest.request_body")
     * @param SalonDTO $salonDTO
     * @return View
     */
    public function postSalon(SalonDTO $salonDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $salon = $this->salonService->addSalon($salonDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($salon, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Salon resource
     * @Rest\Get("/salons/{salonId}")
     * @param int $salonId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getSalon(int $salonId): View
    {
        $salon = $this->salonService->getSalon($salonId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($salon, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Salon resource
     * @Rest\Get("/salons")
     * @return View
     */
    public function getSalons(): View
    {
        $salons = $this->salonService->getAllSalons();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of salon object
        return View::create($salons, Response::HTTP_OK);
    }

    /**
     * Replaces Salon resource
     * @Rest\Put("/salons/{id}")
     * @ParamConverter("salonDTO", converter="fos_rest.request_body")
     * @param int $salonId
     * @param SalonDTO $salonDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putSalon(int $salonId, SalonDTO $salonDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $salon = $this->salonService->updateSalon($salonId, $salonDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($salon, Response::HTTP_OK);
    }

    /**
     * Removes the Salon resource
     * @Rest\Delete("/salons/{salonId}")
     * @param int $salonId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteSalon(int $salonId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $this->salonService->deleteSalon($salonId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
