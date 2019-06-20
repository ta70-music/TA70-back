<?php

namespace App\Application\DTO;

use App\Domain\Model\User\User;

/**
 * Class AlbumDTO
 * @package App\Application\DTO
 */
final class AlbumDTO
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * AlbumDTO constructor.
     * @param string $title
     * @param string $content
     * @param User $user
     */
    public function __construct(string $title = '', string $content = '', User $user)
    {
        $this->title = $title;
        $this->content = $content;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return User
     */
    public function getOwner(): string
    {
        return $this->user;
    }

}
