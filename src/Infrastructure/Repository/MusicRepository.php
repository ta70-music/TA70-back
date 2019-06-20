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
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Article::class);
    }

    /**
     * @param int $articleId
     * @return Article
     */
    public function findById(int $articleId): ?Article
    {
        return $this->objectRepository->find($articleId);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @param Article $article
     */
    public function save(Article $article): void
    {
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }

    /**
     * @param Article $article
     */
    public function delete(Article $article): void
    {
        $this->entityManager->remove($article);
        $this->entityManager->flush();
    }
}
