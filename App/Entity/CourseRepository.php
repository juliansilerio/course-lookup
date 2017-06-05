<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CourseRepository extends EntityRepository {

    public function make_qb() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb;
    }
    
    public function find_course($subject, $bulletin_prefix, $course_number) {
        $qb = $this->make_qb();
        $query = $qb->select('course')
            ->from('App\Entity\Course', 'course')
            ->where(
                $qb->expr()->eq('course.subject', ':subj'),
                $qb->expr()->eq('course.bulletin_prefix', ':prefix'),
                $qb->expr()->eq('course.course_number', ':number')
            )
            ->setParameter(':subj', $subject)
            ->setParameter(':prefix', $bulletin_prefix)
            ->setParameter(':number', $course_number);
        
        return $query->getQuery();
    }

    public function most_courses() {
        $qb = $this->make_qb();
        $query = $qb->select('course.department, COUNT(course.department) ct')
            ->from('App\Entity\Course', 'course')
            ->groupBy('course.department')
            ->orderBy('ct', 'DESC');

        return $query->getQuery();
    }

    public function most_used_words() {
        $qb = $this->make_qb();
        $query = $qb->select('course.name')
            ->from('App\Entity\Course', 'course')
            ->groupBy('course.name');
        return $query->getQuery();
    }

    public function column_lookup($column, $arg) {
        $qb = $this->make_qb();
        $query = $qb->select('course')
            ->from('App\Entity\Course', 'course')
            ->where(
                $qb->expr()->eq('course.'.$column, ':arg')
            )
            ->setParameter(':arg', $arg);
        return $query->getQuery();
    }

    public function find_word($word) {
        $qb = $this->make_qb();
        $query = $qb->select('course')
            ->from('App\Entity\Course', 'course')
            ->where('course.name like :name')
            ->setParameter('name', '%'.$word.'%');
        return $query->getQuery();

    }

}

?>
