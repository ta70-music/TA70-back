<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Message\MessageRepositoryInterface;
use App\Domain\Model\Message\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MessageRepository
 * @package App\Infrastructure\Repository
 */
final class MessageRepository implements MessageRepositoryInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * MessageRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Message::class);
    }

    /**
     * @param int $messageId
     * @return Message
     */
    public function findById(int $messageId): ?Message
    {
        return $this->objectRepository->find($messageId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Message $message
     */
    public function save(Message $message): void
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }

    /**
     * @param Message $message
     */
    public function delete(Message $message): void
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }
}
