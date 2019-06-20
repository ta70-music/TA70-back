<?php

namespace App\Domain\Model\LoginHistory;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class LoginHistory
 * @ORM\Entity
 * @package App\Domain\Model\LoginHistory
 */
class LoginHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Timestamp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Success;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\User\User", inversedBy="loginHistories")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->Timestamp;
    }

    public function setTimestamp(\DateTimeInterface $Timestamp): self
    {
        $this->Timestamp = $Timestamp;

        return $this;
    }

    public function getSuccess(): ?bool
    {
        return $this->Success;
    }

    public function setSuccess(bool $Success): self
    {
        $this->Success = $Success;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->Ip;
    }

    public function setIp(string $Ip): self
    {
        $this->Ip = $Ip;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
