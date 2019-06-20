<?php


namespace App\Application\DTO;


use App\Domain\Model\Album\Album;

/**
 * Class AlbumAssembler
 * @package App\Application\DTO
 */
final class AlbumAssembler
{

    /**
     * @param AlbumDTO $albumDTO
     * @param Album|null $album
     * @return Album
     */
    public function readDTO(AlbumDTO $albumDTO, ?Album $album = null): Album
    {
        if (!$album) {
            $album = new Album();
        }

        $album->setContent($albumDTO->getContent());
        $album->setTitle($albumDTO->getTitle());

        return $album;
    }

    /**
     * @param Album $album
     * @param AlbumDTO $albumDTO
     * @return Album
     */
    public function updateAlbum(Album $album, AlbumDTO $albumDTO): Album
    {
        return $this->readDTO($albumDTO, $album);
    }

    /**
     * @param AlbumDTO $albumDTO
     * @return Album
     */
    public function createAlbum(AlbumDTO $albumDTO): Album
    {
        return $this->readDTO($albumDTO);
    }

    /**
     * @param Album $album
     * @return AlbumDTO
     */
    public function writeDTO(Album $album)
    {
        return new AlbumDTO(
            $album->getTitle(),
            $album->getContent()
        );
    }

}
