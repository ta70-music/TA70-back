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

    /**
     * Lists all Musics.
     * @Rest\Put("/{id}")
     *
     * @return Response
     */
    public function updateOne(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Music::class);
        $music = $repository->find($id);
        $title = $request->request->get('title');
        $file = $request->request->get('file');
        $music->setFile($file);
        $music->setTitle($title);
        $this->getDoctrine()->getManager()->flush();
        return new Response('', 200);

    }

    /**
     * Lists all Musics.
     * @Rest\Delete("/{id}")
     *
     * @return Response
     */
    public function deleteOne(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Music::class);
        $music = $repository->find($id);
        $em->remove($music);
        $this->getDoctrine()->getManager()->flush();
        return new Response('', 200);
    }

}