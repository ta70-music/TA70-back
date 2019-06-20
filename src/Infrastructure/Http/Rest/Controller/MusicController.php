<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\MusicDTO;
use App\Application\Service\MusicService;
use App\Domain\Model\Music\Music;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MusicController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class MusicController extends FOSRestController
{
    /**
     * @var MusicService
     */
    private $musicService;

    /**
     * MusicController constructor.
     * @param MusicService $musicService
     */
    public function __construct(MusicService $musicService)
    {
        $this->musicService = $musicService;
    }

    /**
     * Creates an Music resource
     * @Rest\Post("/musics")
     * @ParamConverter("musicDTO", converter="fos_rest.request_body")
     * @param MusicDTO $musicDTO
     * @return View
     */
    public function postMusic(MusicDTO $musicDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $music = $this->musicService->addMusic($musicDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($music, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Music resource
     * @Rest\Get("/musics/{musicId}")
     * @param int $musicId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getMusic(int $musicId): View
    {
        $music = $this->musicService->getMusic($musicId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($music, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Music resource
     * @Rest\Get("/musics")
     * @return View
     */
    public function getMusics(): View
    {
        $musics = $this->musicService->getAllMusics();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of music object
        return View::create($musics, Response::HTTP_OK);
    }

    /**
     * Replaces Music resource
     * @Rest\Put("/musics/{id}")
     * @ParamConverter("musicDTO", converter="fos_rest.request_body")
     * @param int $musicId
     * @param MusicDTO $musicDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putMusic(int $musicId, MusicDTO $musicDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $music = $this->musicService->updateMusic($musicId, $musicDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($music, Response::HTTP_OK);
    }

    /**
     * Removes the Music resource
     * @Rest\Delete("/musics/{musicId}")
     * @param int $musicId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteMusic(int $musicId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $this->musicService->deleteMusic($musicId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
