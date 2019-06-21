<?php

namespace App\Domain\Model\User;

use App\Domain\Model\ListenHistory\ListenHistory;
use App\Domain\Model\LoginHistory\LoginHistory;
use App\Domain\Model\Message\Message;
use App\Domain\Model\Music\Music;
use App\Domain\Model\Salon\Salon;
use App\Domain\Model\SearchHistory\SearchHistory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @ORM\Entity
 * @package App\Domain\Model\User
 */
class User implements UserInterface
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
    private $Firstname;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\User\User", inversedBy="users")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\User\User", mappedBy="user")
     * @var User $user
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\LoginHistory\LoginHistory", mappedBy="user")
     */
    private $loginHistories;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Message\Message", mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Model\Salon\Salon", mappedBy="user")
     */
    private $salons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\ListenHistory\ListenHistory", mappedBy="user")
     */
    private $listenHistories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\SearchHistory\SearchHistory", mappedBy="user")
     */
    private $searchHistories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Model\Music\Music", mappedBy="User")
     */
    private $musics;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->loginHistories = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->salons = new ArrayCollection();
        $this->listenHistories = new ArrayCollection();
        $this->searchHistories = new ArrayCollection();
        $this->musics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(self $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection|LoginHistory[]
     */
    public function getLoginHistories(): Collection
    {
        return $this->loginHistories;
    }

    public function addLoginHistory(LoginHistory $loginHistory): self
    {
        if (!$this->loginHistories->contains($loginHistory)) {
            $this->loginHistories[] = $loginHistory;
            $loginHistory->setUser($this);
        }

        return $this;
    }

    public function removeLoginHistory(LoginHistory $loginHistory): self
    {
        if ($this->loginHistories->contains($loginHistory)) {
            $this->loginHistories->removeElement($loginHistory);
            // set the owning side to null (unless already changed)
            if ($loginHistory->getUser() === $this) {
                $loginHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Salon[]
     */
    public function getSalons(): Collection
    {
        return $this->salons;
    }

    public function addSalon(Salon $salon): self
    {
        if (!$this->salons->contains($salon)) {
            $this->salons[] = $salon;
            $salon->setUser($this);
        }

        return $this;
    }

    public function removeSalon(Salon $salon): self
    {
        if ($this->salons->contains($salon)) {
            $this->salons->removeElement($salon);
            // set the owning side to null (unless already changed)
            if ($salon->getUser() === $this) {
                $salon->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ListenHistory[]
     */
    public function getListenHistories(): Collection
    {
        return $this->listenHistories;
    }

    public function addListenHistory(ListenHistory $listenHistory): self
    {
        if (!$this->listenHistories->contains($listenHistory)) {
            $this->listenHistories[] = $listenHistory;
            $listenHistory->addUser($this);
        }

        return $this;
    }

    public function removeListenHistory(ListenHistory $listenHistory): self
    {
        if ($this->listenHistories->contains($listenHistory)) {
            $this->listenHistories->removeElement($listenHistory);
            $listenHistory->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|SearchHistory[]
     */
    public function getSearchHistories(): Collection
    {
        return $this->searchHistories;
    }

    public function addSearchHistory(SearchHistory $searchHistory): self
    {
        if (!$this->searchHistories->contains($searchHistory)) {
            $this->searchHistories[] = $searchHistory;
            $searchHistory->addUser($this);
        }

        return $this;
    }

    public function removeSearchHistory(SearchHistory $searchHistory): self
    {
        if ($this->searchHistories->contains($searchHistory)) {
            $this->searchHistories->removeElement($searchHistory);
            $searchHistory->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Music[]
     */
    public function getMusics(): Collection
    {
        return $this->musics;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->musics->contains($music)) {
            $this->musics[] = $music;
            $music->addUser($this);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        if ($this->musics->contains($music)) {
            $this->musics->removeElement($music);
            $music->removeUser($this);
        }

        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->Email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
}