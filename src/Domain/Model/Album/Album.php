<?php

namespace App\Domain\Model\Album;

use App\Domain\Model\Music\Music;
use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Music\Music", inversedBy="albums")
     */
    private $music;

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

    public function getMusic(): ?Music
    {
        return $this->music;
    }

    public function setMusic(?Music $music): self
    {
        $this->music = $music;

        return $music;
    }
}
