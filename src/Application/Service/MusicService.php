<?php

namespace App\Application\Service;


use App\Application\DTO\MusicAssembler;
use App\Application\DTO\MusicDTO;
use App\Domain\Model\Music\Music;
use App\Domain\Model\Music\MusicRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class MusicService
 * @package App\Application\Service
 */
final class MusicService
{

    /**
     * @var MusicRepositoryInterface
     */
    private $musicRepository;

    /**
     * @var MusicAssembler
     */
    private $musicAssembler;

    /**
     * MusicService constructor.
     * @param MusicRepositoryInterface $musicRepository
     * @param MusicAssembler $musicAssembler
     */
    public function __construct(
        MusicRepositoryInterface $musicRepository,
        MusicAssembler $musicAssembler
    ) {
        $this->musicRepository = $musicRepository;
        $this->musicAssembler = $musicAssembler;
    }

    /**
     * @param int $musicId
     * @return Music
     * @throws EntityNotFoundException
     */
    public function getMusic(int $musicId): Music
    {
        $music = $this->musicRepository->findById($musicId);
        if (!$music) {
            throw new EntityNotFoundException('Music with id '.$musicId.' does not exist!');
        }
        return $music;
    }

    /**
     * @return array|null
     */
    public function getAllMusics(): ?array
    {
        return $this->musicRepository->findAll();
    }

    /**
     * @param MusicDTO $musicDTO
     * @return Music
     */
    public function addMusic(MusicDTO $musicDTO): Music
    {
        $music = $this->musicAssembler->createMusic($musicDTO);
        $this->musicRepository->save($music);

        return $music;
    }

    /**
     * @param int $musicId
     * @param MusicDTO $musicDTO
     * @return Music
     * @throws EntityNotFoundException
     */
    public function updateMusic(int $musicId, MusicDTO $musicDTO): Music
    {
        $music = $this->musicRepository->findById($musicId);
        if (!$music) {
            throw new EntityNotFoundException('Music with id '.$musicId.' does not exist!');
        }
        $music = $this->musicAssembler->updateMusic($music, $musicDTO);
        $this->musicRepository->save($music);

        return $music;
    }

    /**
     * @param int $musicId
     * @throws EntityNotFoundException
     */
    public function deleteMusic(int $musicId): void
    {
        $music = $this->musicRepository->findById($musicId);
        if (!$music) {
            throw new EntityNotFoundException('Music with id '.$musicId.' does not exist!');
        }

        $this->musicRepository->delete($music);
    }

}
