<?php

namespace App\Domain\Model\Music;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Music
 * @ORM\Entity
 * @package App\Domain\Model\Music
 */
class Music
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $File;


    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\ListenHistory\ListenHistory", inversedBy="musics")
     */
    private $listenhistory;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Category\Category", mappedBy="music")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Album\Album", mappedBy="music")
     */
    private $albums;

    public function __construct()
    {
        $this->User = new ArrayCollection();
        $this->listenhistory = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->File;
    }

    public function setFile(string $File): self
    {
        $this->File = $File;

        return $this;
    }



    /**
     * @return Collection|ListenHistory[]
     */
    public function getListenhistory(): Collection
    {
        return $this->listenhistory;
    }

    public function addListenhistory(ListenHistory $listenhistory): self
    {
        if (!$this->listenhistory->contains($listenhistory)) {
            $this->listenhistory[] = $listenhistory;
        }

        return $this;
    }

    public function removeListenhistory(ListenHistory $listenhistory): self
    {
        if ($this->listenhistory->contains($listenhistory)) {
            $this->listenhistory->removeElement($listenhistory);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addMusic($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeMusic($this);
        }

        return $this;
    }

    /**
     * @return Collection|Albums[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Albums $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->addMusic($this);
        }

        return $this;
    }

    public function removeAlbum(Albums $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            $album->removeMusic($this);
        }

        return $this;
    }
}
