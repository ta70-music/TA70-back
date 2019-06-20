<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\AlbumDTO;
use App\Application\Service\AlbumService;
use App\Domain\Model\Album\Album;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AlbumController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class AlbumController extends FOSRestController
{
    /**
     * @var AlbumService
     */
    private $albumService;

    /**
     * AlbumController constructor.
     * @param AlbumService $albumService
     */
    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }

    /**
     * Creates an Album resource
     * @Rest\Post("/albums")
     * @ParamConverter("albumDTO", converter="fos_rest.request_body")
     * @param AlbumDTO $albumDTO
     * @return View
     */
    public function postAlbum(AlbumDTO $albumDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($albumDTO->getOwner() == $this->getUser())
        {
            $data = [
                'message' => "Invalid User"
            ];

            return new JsonResponse($data, Response::HTTP_FORBIDDEN);
        }
        $album = $this->albumService->addAlbum($albumDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($album, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Album resource
     * @Rest\Get("/albums/{albumId}")
     * @param int $albumId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getAlbum(int $albumId): View
    {
        $album = $this->albumService->getAlbum($albumId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($album, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Album resource
     * @Rest\Get("/albums")
     * @return View
     */
    public function getAlbums(): View
    {
        $albums = $this->albumService->getAllAlbums();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of album object
        return View::create($albums, Response::HTTP_OK);
    }

    /**
     * Replaces Album resource
     * @Rest\Put("/albums/{id}")
     * @ParamConverter("albumDTO", converter="fos_rest.request_body")
     * @param int $albumId
     * @param AlbumDTO $albumDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putAlbum(int $albumId, AlbumDTO $albumDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($albumDTO->getOwner() == $this->getUser())
        {
            $data = [
                'message' => "Invalid User"
            ];

            return new JsonResponse($data, Response::HTTP_FORBIDDEN);
        }
        $album = $this->albumService->updateAlbum($albumId, $albumDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($album, Response::HTTP_OK);
    }

    /**
     * Removes the Album resource
     * @Rest\Delete("/albums/{albumId}")
     * @param int $albumId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteAlbum(int $albumId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $album = $this->albumService->getAlbum($albumId);
        if ($album->get == $this->getUser())
        {
            $data = [
                'message' => "Invalid User"
            ];

            return new JsonResponse($data, Response::HTTP_FORBIDDEN);
        }
        $this->albumService->deleteAlbum($albumId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
