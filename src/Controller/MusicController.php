<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Music;
use App\Form\MusicForm;

/**
 * Music controller.
 * @Route("/musics", name="music_")
 */
class MusicController extends AbstractFOSRestController
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

    /**
     * Lists all Musics.
     * @Rest\Get("/{id}")
     *
     * @return Response
     */
    public function getOne($id)
    {
        $repository = $this->getDoctrine()->getRepository(Music::class);
        $music = $repository->find($id);
        return $this->handleView($this->view($music));
    }

    /**
     * Lists all Musics.
     * @Rest\Post("")
     *
     * @return Response
     */
    public function createOne(Request $req)
    {
        $file= $req->request->get('file');
        $title= $req->request->get('title');
        print_r($title);

        $music = new Music();
        $music->setFile($file);
        $music->setTitle($title);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($music);
        $entityManager->flush();
        return new Response("",200);
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