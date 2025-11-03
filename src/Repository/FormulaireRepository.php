<?php
// src/Repository/FormulaireRepository.php
namespace App\Repository;

use App\Entity\Formulaire;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Formulaire>
 */
class FormulaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formulaire::class);
    }

    // Метод для создания запроса с фильтрами и сортировкой
    public function createQueryForUserWithFilters(User $user, array $filters = []): QueryBuilder
    {
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.student', 's')
            ->where('f.student = :user OR f.commandant = :user OR f.director = :user')
            ->setParameter('user', $user);

        // Применяем фильтры
        if (!empty($filters['studentName'])) {
            $qb->andWhere('(s.firstname LIKE :studentName OR s.lastname LIKE :studentName)')
            ->setParameter('studentName', '%' . $filters['studentName'] . '%');
        }

        if (!empty($filters['guardianName'])) {
            $qb->andWhere('f.GuardianName LIKE :guardianName')
               ->setParameter('guardianName', '%' . $filters['guardianName'] . '%');
        }

        if (!empty($filters['trainingAdvisor'])) {
            $qb->andWhere('f.TrainingAdvisor LIKE :trainingAdvisor')
               ->setParameter('trainingAdvisor', '%' . $filters['trainingAdvisor'] . '%');
        }

        if (!empty($filters['startDateFrom'])) {
            $qb->andWhere('f.StartDate >= :startDateFrom')
               ->setParameter('startDateFrom', $filters['startDateFrom']);
        }

        if (!empty($filters['startDateTo'])) {
            $qb->andWhere('f.StartDate <= :startDateTo')
               ->setParameter('startDateTo', $filters['startDateTo']);
        }

        // Сортировка
        $sortBy = $filters['sortBy'] ?? 'created_desc';
        switch ($sortBy) {
            case 'created_asc':
                $qb->orderBy('f.id', 'ASC');
                break;
            case 'society_asc':
                $qb->orderBy('f.SocietyName', 'ASC');
                break;
            case 'society_desc':
                $qb->orderBy('f.SocietyName', 'DESC');
                break;
            case 'start_date_asc':
                $qb->orderBy('f.StartDate', 'ASC');
                break;
            case 'start_date_desc':
                $qb->orderBy('f.StartDate', 'DESC');
                break;
            case 'student_asc': // Добавлена сортировка по стажеру
                $qb->orderBy('s.lastname', 'ASC')->addOrderBy('s.firstname', 'ASC');
                break;
            case 'student_desc': // Добавлена сортировка по стажеру
                $qb->orderBy('s.lastname', 'DESC')->addOrderBy('s.firstname', 'DESC');
                break;   
            default: // created_desc
                $qb->orderBy('f.id', 'DESC');
                break;
        }

        return $qb;
    }

    public function findAllForUser(User $user): array
    {
        return $this->createQueryBuilder('f')
            ->where('f.student = :user OR f.commandant = :user OR f.director = :user')
            ->setParameter('user', $user)
            ->orderBy('f.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findForUser(int $id, User $user): ?Formulaire
    {
        $qb = $this->createQueryBuilder('f')
            ->andWhere('f.id = :id')
            ->setParameter('id', $id);
        
        if (in_array('ROLE_STAGIAIRE', $user->getRoles())) {
            $qb->andWhere('f.student = :user')
               ->setParameter('user', $user);
        } elseif (in_array('ROLE_COMMANDANT', $user->getRoles())) {
            $qb->join('f.student', 's')
               ->andWhere('s.company = :company')
               ->setParameter('company', $user->getCompany());
        }
        
        return $qb->getQuery()
                 ->getOneOrNullResult();
    }
}