<?php

namespace App\Application\Service;


use App\Application\DTO\MessageAssembler;
use App\Application\DTO\MessageDTO;
use App\Domain\Model\Message\Message;
use App\Domain\Model\Message\MessageRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class MessageService
 * @package App\Application\Service
 */
final class MessageService
{

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * @var MessageAssembler
     */
    private $messageAssembler;

    /**
     * MessageService constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param MessageAssembler $messageAssembler
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        MessageAssembler $messageAssembler
    ) {
        $this->messageRepository = $messageRepository;
        $this->messageAssembler = $messageAssembler;
    }

    /**
     * @param int $messageId
     * @return Message
     * @throws EntityNotFoundException
     */
    public function getMessage(int $messageId): Message
    {
        $message = $this->messageRepository->findById($messageId);
        if (!$message) {
            throw new EntityNotFoundException('Message with id '.$messageId.' does not exist!');
        }
        return $message;
    }

    /**
     * @return array|null
     */
    public function getAllMessages(): ?array
    {
        return $this->messageRepository->findAll();
    }

    /**
     * @param MessageDTO $messageDTO
     * @return Message
     */
    public function addMessage(MessageDTO $messageDTO): Message
    {
        $message = $this->messageAssembler->createMessage($messageDTO);
        $this->messageRepository->save($message);

        return $message;
    }

    /**
     * @param int $messageId
     * @param MessageDTO $messageDTO
     * @return Message
     * @throws EntityNotFoundException
     */
    public function updateMessage(int $messageId, MessageDTO $messageDTO): Message
    {
        $message = $this->messageRepository->findById($messageId);
        if (!$message) {
            throw new EntityNotFoundException('Message with id '.$messageId.' does not exist!');
        }
        $message = $this->messageAssembler->updateMessage($message, $messageDTO);
        $this->messageRepository->save($message);

        return $message;
    }

    /**
     * @param int $messageId
     * @throws EntityNotFoundException
     */
    public function deleteMessage(int $messageId): void
    {
        $message = $this->messageRepository->findById($messageId);
        if (!$message) {
            throw new EntityNotFoundException('Message with id '.$messageId.' does not exist!');
        }

        $this->messageRepository->delete($message);
    }

}
