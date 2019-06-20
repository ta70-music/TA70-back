<?php

namespace App\Domain\Model\Album;

/**
 * Interface AlbumRepositoryInterface
 * @package App\Domain\Model\Album
 */
interface AlbumRepositoryInterface
{

    /**
     * @param int $albumId
     * @return Album
     */
    public function findById(int $albumId): ?Album;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Album $album
     */
    public function save(Album $album): void;

    /**
     * @param Album $album
     */
    public function delete(Album $album): void;

}
