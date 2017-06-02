<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CourseRepository extends EntityRepository {

    public function find_course($subject, $bulletin_prefix, $course_number) {
        $qb = $em->createQueryBuilder();
        $query = $qb->select('course')
            ->from('Course', 'course')
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

}

?>
