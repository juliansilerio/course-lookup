<?php

namespace src\course_lookup\Service;

use Doctrine\ORM\EntityManager;

class ColumnLookupService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function column_lookup($column, $arg) {
        $repo = $this->em->getRepository('src\course_lookup\Entity\Course');
        $result = $repo->column_lookup($column, $arg);
        return $result->getArrayResult();
    }
}

?>
