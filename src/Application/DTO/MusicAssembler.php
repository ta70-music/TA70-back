<?php


namespace App\Application\DTO;


use App\Domain\Model\Music\Music;

/**
 * Class MusicAssembler
 * @package App\Application\DTO
 */
final class MusicAssembler
{

    /**
     * @param MusicDTO $musicDTO
     * @param Music|null $music
     * @return Music
     */
    public function readDTO(MusicDTO $musicDTO, ?Music $music = null): Music
    {
        if (!$music) {
            $music = new Music();
        }

        $music->setContent($musicDTO->getContent());
        $music->setTitle($musicDTO->getTitle());

        return $music;
    }

    /**
     * @param Music $music
     * @param MusicDTO $musicDTO
     * @return Music
     */
    public function updateMusic(Music $music, MusicDTO $musicDTO): Music
    {
        return $this->readDTO($musicDTO, $music);
    }

    /**
     * @param MusicDTO $musicDTO
     * @return Music
     */
    public function createMusic(MusicDTO $musicDTO): Music
    {
        return $this->readDTO($musicDTO);
    }

    /**
     * @param Music $music
     * @return MusicDTO
     */
    public function writeDTO(Music $music)
    {
        return new MusicDTO(
            $music->getTitle(),
            $music->getContent()
        );
    }

}
