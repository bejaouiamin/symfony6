<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * #[ORM\Entity(repositoryClass: UserRepository::class)]
 * #[ApiResource(
 *     collectionOperations: ["post"],
 *     itemOperations: ["get"]
 * )]
 */

#[ApiResource(
    collectionOperations: ["post"],
    itemOperations: ["get"]
)]

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @ORM\Column(length=180, unique=true)
     */
    private ?string $email = null;

     
    #[ORM\Column(length: 255)]
    private string $roles = '';

    // Your existing methods...

    public function __construct()
    {
        // Initialize roles with a default value
        $this->roles = ['ROLE_USER'];
    }

    /**
     * @ORM\Column
     */
    private ?string $password = null;

    private ?string $plainPassword = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        return explode(',', $this->roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = implode(',', $roles);

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $password): self
    {
        $this->plainPassword = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }
}
