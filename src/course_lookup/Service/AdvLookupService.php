<?php

namespace src\course_lookup\Service;

use Doctrine\ORM\EntityManager;

class AdvLookupService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function adv_lookup_course($department, $course_level, $subject) {
        
        $repo = $this->em->getRepository('src\course_lookup\Entity\Course');
        
        //print "$department $course_level $subject\n";
        
        $result = $repo->adv_lookup($department, $course_level, $subject);
        return $result->getArrayResult();
    }
}

?>
