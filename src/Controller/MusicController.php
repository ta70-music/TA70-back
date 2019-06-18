<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Music;
use App\Form\MusicForm;

/**
 * Music controller.
 * @Route("/musics", name="music_")
 */
class MusicController extends FOSRestController
{
    /**
     * Lists all Musics.
     * @Rest\Get("")
     *
     * @return Response
     */
    public function getAll()
    {
        $repository = $this->getDoctrine()->getRepository(Music::class);
        $musics = $repository->findall();
        return $this->handleView($this->view($musics));
    }
//
//    /**
//     * Create Movie.
//     * @Rest\Post("/movie")
//     *
//     * @return Response
//     */
//    public function postMovieAction(Request $request)
//    {
//        $movie = new Movie();
//        $form = $this->createForm(MovieType::class, $movie);
//
//        $data = json_decode($request->getContent(), true);
//        $form->submit($data);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($movie);
//            $em->flush();
//            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
//        }
//
//        return $this->handleView($this->view($form->getErrors()));
//    }

}