<?php

namespace App\Domain\Model\Music;

/**
 * Interface MusicRepositoryInterface
 * @package App\Domain\Model\Music
 */
interface MusicRepositoryInterface
{

    /**
     * @param int $musicId
     * @return Music
     */
    public function findById(int $musicId): ?Music;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Music $music
     */
    public function save(Music $music): void;

    /**
     * @param Music $music
     */
    public function delete(Music $music): void;

}
