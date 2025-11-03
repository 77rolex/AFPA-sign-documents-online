<?php
# src/Entity/User.php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];


    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Company $company = null;

    /**
     * @var Collection<int, Formulaire>
     */
    #[ORM\OneToMany(targetEntity: Formulaire::class, mappedBy: 'commandant')]
    private Collection $formulairesAsCommandant;

    /**
     * @var Collection<int, Formulaire>
     */
    #[ORM\OneToMany(targetEntity: Formulaire::class, mappedBy: 'director')]
    private Collection $formulairesAsDirector;

    /**
     * @var Collection<int, Formulaire>
     */
    #[ORM\OneToMany(targetEntity: Formulaire::class, mappedBy: 'student')]
    private Collection $formulairesAsStudent;


    public function __construct()
    {
        $this->formulairesAsCommandant = new ArrayCollection();
        $this->formulairesAsDirector = new ArrayCollection();
        $this->formulairesAsStudent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Formulaire>
     */
    public function getFormulairesAsCommandant(): Collection
    {
        return $this->formulairesAsCommandant;
    }

    public function addFormulairesAsCommandant(Formulaire $formulaire): static
    {
        if (!$this->formulairesAsCommandant->contains($formulaire)) {
            $this->formulairesAsCommandant->add($formulaire);
            $formulaire->setCommandant($this);
        }

        return $this;
    }

    public function removeFormulairesAsCommandant(Formulaire $formulaire): static
    {
        if ($this->formulairesAsCommandant->removeElement($formulaire)) {
            if ($formulaire->getCommandant() === $this) {
                $formulaire->setCommandant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formulaire>
     */
    public function getFormulairesAsDirector(): Collection
    {
        return $this->formulairesAsDirector;
    }

    public function addFormulairesAsDirector(Formulaire $formulaire): static
    {
        if (!$this->formulairesAsDirector->contains($formulaire)) {
            $this->formulairesAsDirector->add($formulaire);
            $formulaire->setDirector($this);
        }

        return $this;
    }

    public function removeFormulairesAsDirector(Formulaire $formulaire): static
    {
        if ($this->formulairesAsDirector->removeElement($formulaire)) {
            if ($formulaire->getDirector() === $this) {
                $formulaire->setDirector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formulaire>
     */
    public function getFormulairesAsStudent(): Collection
    {
        return $this->formulairesAsStudent;
    }

    public function addFormulairesAsStudent(Formulaire $formulaire): static
    {
        if (!$this->formulairesAsStudent->contains($formulaire)) {
            $this->formulairesAsStudent->add($formulaire);
            $formulaire->setStudent($this);
        }

        return $this;
    }

    public function removeFormulairesAsStudent(Formulaire $formulaire): static
    {
        if ($this->formulairesAsStudent->removeElement($formulaire)) {
            if ($formulaire->getStudent() === $this) {
                $formulaire->setStudent(null);
            }
        }

        return $this;
    }

}
