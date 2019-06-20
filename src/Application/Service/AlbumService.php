<?php

namespace App\Application\Service;


use App\Application\DTO\AlbumAssembler;
use App\Application\DTO\AlbumDTO;
use App\Domain\Model\Album\Album;
use App\Domain\Model\Album\AlbumRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class AlbumService
 * @package App\Application\Service
 */
final class AlbumService
{

    /**
     * @var AlbumRepositoryInterface
     */
    private $albumRepository;

    /**
     * @var AlbumAssembler
     */
    private $albumAssembler;

    /**
     * AlbumService constructor.
     * @param AlbumRepositoryInterface $albumRepository
     * @param AlbumAssembler $albumAssembler
     */
    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        AlbumAssembler $albumAssembler
    ) {
        $this->albumRepository = $albumRepository;
        $this->albumAssembler = $albumAssembler;
    }

    /**
     * @param int $albumId
     * @return Album
     * @throws EntityNotFoundException
     */
    public function getAlbum(int $albumId): Album
    {
        $album = $this->albumRepository->findById($albumId);
        if (!$album) {
            throw new EntityNotFoundException('Album with id '.$albumId.' does not exist!');
        }
        return $album;
    }

    /**
     * @return array|null
     */
    public function getAllAlbums(): ?array
    {
        return $this->albumRepository->findAll();
    }

    /**
     * @param AlbumDTO $albumDTO
     * @return Album
     */
    public function addAlbum(AlbumDTO $albumDTO): Album
    {
        $album = $this->albumAssembler->createAlbum($albumDTO);
        $this->albumRepository->save($album);

        return $album;
    }

    /**
     * @param int $albumId
     * @param AlbumDTO $albumDTO
     * @return Album
     * @throws EntityNotFoundException
     */
    public function updateAlbum(int $albumId, AlbumDTO $albumDTO): Album
    {
        $album = $this->albumRepository->findById($albumId);
        if (!$album) {
            throw new EntityNotFoundException('Album with id '.$albumId.' does not exist!');
        }
        $album = $this->albumAssembler->updateAlbum($album, $albumDTO);
        $this->albumRepository->save($album);

        return $album;
    }

    /**
     * @param int $albumId
     * @throws EntityNotFoundException
     */
    public function deleteAlbum(int $albumId): void
    {
        $album = $this->albumRepository->findById($albumId);
        if (!$album) {
            throw new EntityNotFoundException('Album with id '.$albumId.' does not exist!');
        }

        $this->albumRepository->delete($album);
    }

}
