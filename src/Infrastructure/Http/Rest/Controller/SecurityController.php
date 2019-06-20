<?php

namespace App\Infrastructure\Http\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $data = [
            'message' => $authenticationUtils->getLastAuthenticationError()
        ];

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);;
    }
}
