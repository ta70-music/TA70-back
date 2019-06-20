<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Music\MusicRepositoryInterface;
use App\Domain\Model\Music\Music;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MusicRepository
 * @package App\Infrastructure\Repository
 */
final class MusicRepository implements MusicRepositoryInterface
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
     * MusicRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Music::class);
    }

    /**
     * @param int $musicId
     * @return Music
     */
    public function findById(int $musicId): ?Music
    {
        return $this->objectRepository->find($musicId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Music $music
     */
    public function save(Music $music): void
    {
        $this->entityManager->persist($music);
        $this->entityManager->flush();
    }

    /**
     * @param Music $music
     */
    public function delete(Music $music): void
    {
        $this->entityManager->remove($music);
        $this->entityManager->flush();
    }
}
