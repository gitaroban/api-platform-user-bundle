<?php

namespace Aroban\Bundle\UtilisateurBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class ArobanUtilisateur implements ArobanUtilisateurInterface
{
    /**
     * @var ?UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    #[ApiProperty(identifier: true)]
    #[Groups(['user:read'])]
    protected ?UuidInterface $id = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="L'email de l'utilisateur est obligatoire.")
     * @Assert\Email(message="L'email est invalide.")
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
     */
    protected string $password;

    #[SerializedName('password')]
    #[Groups(['user:write'])]
    protected ?string $plainPassword;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Aroban\Bundle\UtilisateurBundle\Entity\ArobanApiToken", mappedBy="utilisateur")
     */
    protected Collection $apiTokens;

    public function __construct()
    {
        $this->apiTokens = new ArrayCollection();
    }

    public function getId(): ?UuidInterface
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

    /**
     * This method can be removed in Symfony 6.0
     *
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
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

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    /**
     * @return Collection|array
     */
    public function getApiTokens(): Collection|array
    {
        return $this->apiTokens;
    }
}
