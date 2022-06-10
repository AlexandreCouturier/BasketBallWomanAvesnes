<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="Votre mot de passe doit contenir au minumun 8 caractères")
     * @Assert\EqualTo(propertyPath="Confirm_Password", message="Les mots de passe ne sont pas identiques")
     */
    private $Password;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumberAddress;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $City;

    /**
     * @ORM\Column(type="integer")
     */
    private $Zip;
    /**
     * @Assert\EqualTo(propertyPath="Password", message="Les mots de passe ne sont pas identiques")
     */
    private $Confirm_Password;

    /**
     * @ORM\ManyToMany(targetEntity=Roles::class, inversedBy="users")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }



    public function getConfirmPassword(): ?string
    {
        return $this->Confirm_Password;
    }

    public function setConfirmPassword(string $Confirm_Password): self
    {
        $this->Confirm_Password = $Confirm_Password;

        return $this;
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

    public function getNumberAddress(): ?int
    {
        return $this->NumberAddress;
    }

    public function setNumberAddress(int $NumberAddress): self
    {
        $this->NumberAddress = $NumberAddress;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->Zip;
    }

    public function setZip(int $Zip): self
    {
        $this->Zip = $Zip;

        return $this;
    }

    /**
     * @return Collection<int, Roles>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Roles $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Roles $role): self
    {
        $this->roles->removeElement($role);

        return $this;
    }


}
