<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\LegacyPasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class ArobanUtilisateur implements UserInterface, PasswordAuthenticatedUserInterface, LegacyPasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id)
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer")
     */
    #[ApiProperty(identifier: true)]
    #[SerializedName('id')]
    #[Groups(['user:read'])]
    protected ?int $uuid = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="L'email de l'utilisateur est obligatoire.")
     * @Assert\Email(message="L'email est invalide.")
     * @Assert\Unique(message="L'email est déjà utilisé.")
     */
    #[Groups(['user:read', 'user:write'])]
    protected string $email;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(['user:read', 'admin:write'])]
    protected array $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom de l'utilisateur est obligatoire.")
     */
    #[Groups(['user:read', 'user:write'])]
    protected string $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom de l'utilisateur est obligatoire.")
     */
    #[Groups(['user:read', 'user:write'])]
    protected string $prenom;

    public function getUuid(): ?int
    {
        return $this->uuid;
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

    /**
     * This method can be removed in Symfony 6.0
     *
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    #[Pure]
    public function getUsername(): string
    {
        return$this->getUserIdentifier();
    }

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

    public function getPassword(): ?string
    {
        return null;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomPrenom($separateur = null): string
    {
        return implode($separateur ?? ' ', [$this->nom, $this->prenom]);
    }

    public function getPrenomNom($separateur = null): string
    {
        return implode($separateur ?? ' ', [$this->prenom, $this->nom]);
    }
}
