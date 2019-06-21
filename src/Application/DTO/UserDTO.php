<?php

namespace App\Application\DTO;

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
     * UserDTO constructor
     * @param string $Firstname
     * @param string $Lastname
     */
    public function __construct(string $Firstname = '', string $Lastname = '', string $Email = '', string $Password = '', string $Image = '', string $Description = '')
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

}
