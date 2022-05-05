<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $LastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Post;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TeamName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->Post;
    }

    public function setPost(string $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getTeamName(): ?Team
    {
        return $this->TeamName;
    }

    public function setTeamName(?Team $TeamName): self
    {
        $this->TeamName = $TeamName;

        return $this;
    }
}
