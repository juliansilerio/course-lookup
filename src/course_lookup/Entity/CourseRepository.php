<?php

namespace src\course_lookup\Entity;

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
            ->from('src\course_lookup\Entity\Course', 'course')
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
            ->from('src\course_lookup\Entity\Course', 'course')
            ->groupBy('course.department')
            ->orderBy('ct', 'DESC');

        return $query->getQuery();
    }

    public function most_used_words() {
        $qb = $this->make_qb();
        $query = $qb->select('course.name')
            ->from('src\course_lookup\Entity\Course', 'course')
            ->groupBy('course.name');
        return $query->getQuery();
    }

    /**
    
    *********************
    *   UNIMPLEMENTED   *
    *********************
    
    public function number_course_levels() {
        $qb = $this->make_qb();
        
        $query = $qb->add('select','c.department, ints.start, count(*)') 
            ->add('from',  'course c, ints') 
            ->add('where', 'c.course_number >= ints.start and c.course_number <= ints.end') 
            ->add('groupBy', 'c.department, ints.start');
        return $query->getQuery();
        

    }

    */

    public function column_lookup($column, $arg) {
        $qb = $this->make_qb();
        $query = $qb->select('course')
            ->from('src\course_lookup\Entity\Course', 'course')
            ->where(
                $qb->expr()->eq('course.'.$column, ':arg')
            )
            ->setParameter(':arg', $arg);
        return $query->getQuery();
    }

    public function find_word($word) {
        $qb = $this->make_qb();
        $query = $qb->select('course')
            ->from('src\course_lookup\Entity\Course', 'course')
            ->where('course.name like :name')
            ->setParameter('name', '%'.$word.'%');
        return $query->getQuery();

    }

    public function adv_lookup($department, $course_level=0, $subject = '') {
        $qb = $this->make_qb();

        $level_search = '';
        $subject_search = '';

        if($course_level) {
            $lower = floor($course_level/1000)*1000;
            $upper = $lower + 1000;
            $level_search = "AND course.course_number >= $lower AND course.course_number < $upper";
        }
        
        if($subject) {
            $subject_search = "AND course.subject = '$subject'";
        }
                
        $query = $qb->select('course')
            ->from('src\course_lookup\Entity\Course', 'course')
            ->where("course.department = :department $level_search $subject_search")
            ->orderBy('course.course_number', 'ASC')
            ->setParameter('department', $department);
        
        return $query->getQuery();
    }

}

?>
