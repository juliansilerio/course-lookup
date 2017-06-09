<?php

namespace src\course_lookup\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\DriverManager;

class CourseLevelsService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function number_course_levels() {
        $repo = $this->em->getRepository('src\course_lookup\Entity\Course');
        $result = $repo->number_course_levels();

        return $result;
    }  
       


}

?>
