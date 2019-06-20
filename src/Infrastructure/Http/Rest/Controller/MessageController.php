<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\MessageDTO;
use App\Application\Service\MessageService;
use App\Domain\Model\Message\Message;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MessageController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class MessageController extends FOSRestController
{
    /**
     * @var MessageService
     */
    private $messageService;

    /**
     * MessageController constructor.
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Creates an Message resource
     * @Rest\Post("/messages")
     * @ParamConverter("messageDTO", converter="fos_rest.request_body")
     * @param MessageDTO $messageDTO
     * @return View
     */
    public function postMessage(MessageDTO $messageDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $message = $this->messageService->addMessage($messageDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($message, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Message resource
     * @Rest\Get("/messages/{messageId}")
     * @param int $messageId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getMessage(int $messageId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $message = $this->messageService->getMessage($messageId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($message, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Message resource
     * @Rest\Get("/messages")
     * @return View
     */
    public function getMessages(): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $messages = $this->messageService->getAllMessages();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of message object
        return View::create($messages, Response::HTTP_OK);
    }

    /**
     * Replaces Message resource
     * @Rest\Put("/messages/{id}")
     * @ParamConverter("messageDTO", converter="fos_rest.request_body")
     * @param int $messageId
     * @param MessageDTO $messageDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putMessage(int $messageId, MessageDTO $messageDTO): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $message = $this->messageService->updateMessage($messageId, $messageDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($message, Response::HTTP_OK);
    }

    /**
     * Removes the Message resource
     * @Rest\Delete("/messages/{messageId}")
     * @param int $messageId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteMessage(int $messageId): View
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //TODO Check User
        $this->messageService->deleteMessage($messageId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
