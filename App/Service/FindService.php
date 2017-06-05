<?php

namespace App\Service;

//use App\Entity\CourseRepository;
use Doctrine\ORM\EntityManager;

class FindService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function find_word($word) {
        $repo = $this->em->getRepository('App\Entity\Course');
        $result = $repo->find_word($word);
        return $result->getArrayResult();
    }
}

?>
