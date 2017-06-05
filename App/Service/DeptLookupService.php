<?php

namespace App\Service;

//use App\Entity\CourseRepository;
use Doctrine\ORM\EntityManager;

class DeptLookupService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function department_lookup($dept) {
        $repo = $this->em->getRepository('App\Entity\Course');
        $result = $repo->department_lookup($dept);
        return $result->getArrayResult();
    }
}

?>
