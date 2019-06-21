<?php

namespace App\Application\DTO;

use mysql_xdevapi\Collection;

/**
 * Class UserDTO
 * @package App\Application\DTO
 */
final class UserDTO
{

    /**
     * @var string
     */
    private $Firstname;

    /**
     * @var string
     */
    private $Lastname;

    /**
     * @var string
     */
    private $Email;

    /**
     * @var string
     */
    private $Password;

    /**
     * @var string
     */
    private $Image;

    /**
     * @var string
     */
    private $Description;

    /**
     * @var Collection
     */
    private $user;

    /**
     * @var Collection
     */
    private $loginHistory;

    /**
     * @var Collection
     */
    private $message;

    /**
     * @var Collection
     */
    private $salon;

    /**
     * @var Collection
     */
    private $listenHistory;

    /**
     * @var Collection
     */
    private $searchHistory;

    /**
     * @var Collection
     */
    private $music;

    /**
     * @var array
     */
    private $roles;

    /**
     * UserDTO constructor
     * @param string $Firstname
     * @param string $Lastname
     */
    public function __construct(string $Firstname = '', string $Lastname = '', string $Email = '', string $Password = '', string $Image = '', string $Description = '', Collection $user = null, Collection $loginHistory = null, Collection $message = null, Collection $salon = null, Collection $listenHistory = null, Collection $searchHistory = null, Collection $music = null, array $roles = null)
    {
        $this->Firstname = $Firstname;
        $this->Lastname = $Lastname;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Image = $Image;
        $this->Description = $Description;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->Firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->Lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->Image;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @return string
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    /**
     * @return Collection
     */
    public function getLoginHistory(): Collection
    {
        return $this->loginHistory;
    }

    /**
     * @return Collection
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    /**
     * @return Collection
     */
    public function getSalon(): Collection
    {
        return $this->salon;
    }

    /**
     * @return Collection
     */
    public function getListenHistory(): Collection
    {
        return $this->listenHistory;
    }

    /**
     * @return Collection
     */
    public function getSearchHistory(): Collection
    {
        return $this->searchHistory;
    }

    /**
     * @return Collection
     */
    public function getMusic(): Collection
    {
        return $this->music;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

}
