<?php


namespace App\Application\DTO;


use App\Domain\Model\Message\Message;

/**
 * Class MessageAssembler
 * @package App\Application\DTO
 */
final class MessageAssembler
{

    /**
     * @param MessageDTO $messageDTO
     * @param Message|null $message
     * @return Message
     */
    public function readDTO(MessageDTO $messageDTO, ?Message $message = null): Message
    {
        if (!$message) {
            $message = new Message();
        }

        $message->setContent($messageDTO->getContent());
        $message->setTitle($messageDTO->getTitle());

        return $message;
    }

    /**
     * @param Message $message
     * @param MessageDTO $messageDTO
     * @return Message
     */
    public function updateMessage(Message $message, MessageDTO $messageDTO): Message
    {
        return $this->readDTO($messageDTO, $message);
    }

    /**
     * @param MessageDTO $messageDTO
     * @return Message
     */
    public function createMessage(MessageDTO $messageDTO): Message
    {
        return $this->readDTO($messageDTO);
    }

    /**
     * @param Message $message
     * @return MessageDTO
     */
    public function writeDTO(Message $message)
    {
        return new MessageDTO(
            $message->getTitle(),
            $message->getContent()
        );
    }

}
