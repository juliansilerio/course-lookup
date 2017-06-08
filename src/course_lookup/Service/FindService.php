<?php

namespace src\course_lookup\Service;

use Doctrine\ORM\EntityManager;

class FindService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function find_word($word) {
        $repo = $this->em->getRepository('src\course_lookup\Entity\Course');
        $result = $repo->find_word($word);
        return $result->getArrayResult();
    }
}

?>
