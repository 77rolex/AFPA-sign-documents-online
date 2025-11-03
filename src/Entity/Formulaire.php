<?php
// src/Entity/Formulaire.php
namespace App\Entity;

use App\Repository\FormulaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: FormulaireRepository::class)]
class Formulaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $SocietyName = null;

    #[ORM\Column(length: 255)]
    private ?string $SocietyAdress = null;

    #[ORM\Column(length: 255)]
    private ?string $Quality = null;

    #[ORM\Column(length: 255)]
    private ?string $GuardianName = null;

    #[ORM\Column(length: 255)]
    private ?string $GuardianEmail = null;

    // #[ORM\Column]
    // private ?int $GuardianPhone = null;
    #[ORM\Column(length: 20)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Le numéro doit contenir uniquement des chiffres.'
    )]
    private ?string $GuardianPhone = null;


    #[ORM\Column]
    private ?\DateTime $StartDate = null;

    #[ORM\Column]
    private ?\DateTime $EndDate = null;

    #[ORM\Column(length: 255)]
    private ?string $TrainingAdvisor = null;

    #[ORM\Column(length: 255)]
    private ?string $TrainerOfIntern = null;

    // #[ORM\Column]
    // private ?int $SIRETSIREN = null;
    #[ORM\Column(length: 14)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Le numéro doit contenir uniquement des chiffres.'
    )]
    private ?string $SIRETSIREN = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'formulairesAsCommandant')]
    private ?User $commandant = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'formulairesAsDirector')]
    private ?User $director = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'formulairesAsStudent')]
    private ?User $student = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $studentSignature = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $commandantSignature = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $directorSignature = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $societySignature = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private ?string $societySignToken = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocietyName(): ?string
    {
        return $this->SocietyName;
    }

    public function setSocietyName(string $SocietyName): static
    {
        $this->SocietyName = $SocietyName;

        return $this;
    }

    public function getSocietyAdress(): ?string
    {
        return $this->SocietyAdress;
    }

    public function setSocietyAdress(string $SocietyAdress): static
    {
        $this->SocietyAdress = $SocietyAdress;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->Quality;
    }

    public function setQuality(string $Quality): static
    {
        $this->Quality = $Quality;

        return $this;
    }

    public function getGuardianName(): ?string
    {
        return $this->GuardianName;
    }

    public function setGuardianName(string $GuardianName): static
    {
        $this->GuardianName = $GuardianName;

        return $this;
    }

    public function getGuardianEmail(): ?string
    {
        return $this->GuardianEmail;
    }

    public function setGuardianEmail(string $GuardianEmail): static
    {
        $this->GuardianEmail = $GuardianEmail;

        return $this;
    }

   public function getGuardianPhone(): ?string
    {
        return $this->GuardianPhone;
    }

    public function setGuardianPhone(string $GuardianPhone): static
    {
        $this->GuardianPhone = $GuardianPhone;
        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTime $StartDate): static
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTime $EndDate): static
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getTrainingAdvisor(): ?string
    {
        return $this->TrainingAdvisor;
    }

    public function setTrainingAdvisor(string $TrainingAdvisor): static
    {
        $this->TrainingAdvisor = $TrainingAdvisor;

        return $this;
    }

    public function getTrainerOfIntern(): ?string
    {
        return $this->TrainerOfIntern;
    }

    public function setTrainerOfIntern(string $TrainerOfIntern): static
    {
        $this->TrainerOfIntern = $TrainerOfIntern;

        return $this;
    }

    public function getSIRETSIREN(): ?string
    {
        return $this->SIRETSIREN;
    }

    public function setSIRETSIREN(string $SIRETSIREN): static
    {
        $this->SIRETSIREN = $SIRETSIREN;
        return $this;
    }

    public function getCommandant(): ?User
    {
        return $this->commandant;
    }

    public function setCommandant(?User $commandant): static
    {
        $this->commandant = $commandant;

        return $this;
    }

    public function getCommandantSignature(): ?string
    {
        return $this->commandantSignature;
    }

    public function setCommandantSignature(?string $commandantSignature): static
    {
        $this->commandantSignature = $commandantSignature;

        return $this;
    }

    public function getDirector(): ?User
    {
        return $this->director;
    }

    public function setDirector(?User $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getDirectorSignature(): ?string
    {
        return $this->directorSignature;
    }

    public function setDirectorSignature(?string $directorSignature): static
    {
        $this->directorSignature = $directorSignature;

        return $this;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getStudentSignature(): ?string
    {
        return $this->studentSignature;
    }

    public function setStudentSignature(?string $studentSignature): static
    {
        $this->studentSignature = $studentSignature;

        return $this;
    }

    public function getSocietySignature(): ?string
    {
        return $this->societySignature;
    }

    public function setSocietySignature(?string $societySignature): static
    {
        $this->societySignature = $societySignature;

        return $this;
    }

    public function getSocietySignToken(): ?string
    {
        return $this->societySignToken;
    }

    public function setSocietySignToken(?string $societySignToken): static
    {
        $this->societySignToken = $societySignToken;
        return $this;
    }

    public function getStudentFullName(): ?string
    {
        if ($this->student) {
            // return $this->student->getFirstname() . ' ' . $this->student->getLastname();
            return $this->student->getLastname() . ' ' . $this->student->getFirstname();
        }
        
        return null;
    }

    public function getSigningProgress(): int
    {
        $progress = 0;
        
        if ($this->studentSignature !== null) {
            $progress += 25;
        }
        
        if ($this->commandantSignature !== null) {
            $progress += 25;
        }
        
        if ($this->directorSignature !== null) {
            $progress += 25;
        }
        
        if ($this->societySignature !== null) {
            $progress += 25;
        }
        
        return $progress;
    }

    // Дополнительный метод для получения детальной информации
    public function getSigningStatus(): array
    {
        return [
            'student' => $this->studentSignature !== null,
            'commandant' => $this->commandantSignature !== null,
            'director' => $this->directorSignature !== null,
            'society' => $this->societySignature !== null,
            'progress' => $this->getSigningProgress()
        ];
    }
// 19/09
    // public function isEditableBy(User $user): bool
    // {
    //     // Если директор еще не подписал - применяются обычные правила
    //     if ($this->directorSignature === null) {
    //         // Здесь можно добавить дополнительные проверки если нужно
    //         return true;
    //     }
        
    //     // Если директор подписал - только он может редактировать
    //     return $user === $this->director && in_array('ROLE_DIRECTOR', $user->getRoles());
    // }

    // public function isDeletableBy(User $user): bool
    // {
    //     // Если директор еще не подписал - применяются обычные правила
    //     if ($this->directorSignature === null) {
    //         // Здесь можно добавить дополнительные проверки если нужно
    //         return true;
    //     }
        
    //     // Если директор подписал - только он может удалять
    //     return $user === $this->director && in_array('ROLE_DIRECTOR', $user->getRoles());
    // }

    // public function isFullySigned(): bool
    // {
    //     return $this->directorSignature !== null;
    // }
// .
}