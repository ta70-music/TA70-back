<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Album\AlbumRepositoryInterface;
use App\Domain\Model\Album\Album;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AlbumRepository
 * @package App\Infrastructure\Repository
 */
final class AlbumRepository implements AlbumRepositoryInterface
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
     * AlbumRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Album::class);
    }

    /**
     * @param int $albumId
     * @return Album
     */
    public function findById(int $albumId): ?Album
    {
        return $this->objectRepository->find($albumId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Album $album
     */
    public function save(Album $album): void
    {
        $this->entityManager->persist($album);
        $this->entityManager->flush();
    }

    /**
     * @param Album $album
     */
    public function delete(Album $album): void
    {
        $this->entityManager->remove($album);
        $this->entityManager->flush();
    }
}
