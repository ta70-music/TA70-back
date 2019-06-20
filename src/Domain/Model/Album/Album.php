<?php

namespace App\Domain\Model\Album;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Album
 * @ORM\Entity
 * @package App\Domain\Model\Album
 */
class Album
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getIMage(): ?string
    {
        return $this->Image;
    }

    public function setIMage(string $IMage): self
    {
        $this->Image = $IMage;

        return $this;
    }
}
