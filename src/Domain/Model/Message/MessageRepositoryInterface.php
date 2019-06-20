<?php

namespace App\Domain\Model\Message;

/**
 * Interface MessageRepositoryInterface
 * @package App\Domain\Model\Message
 */
interface MessageRepositoryInterface
{

    /**
     * @param int $messageId
     * @return Message
     */
    public function findById(int $messageId): ?Message;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Message $message
     */
    public function save(Message $message): void;

    /**
     * @param Message $message
     */
    public function delete(Message $message): void;

}
