<?php

namespace src\course_lookup\Service;

use Doctrine\ORM\EntityManager;

class LookupService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function lookup_course($call_number) {
        $term = explode(" ", $call_number);
        $subject = $term[0];

        if($term[1] > 5) {
            $pref_length = 2;
        } else {
            $pref_length = 1;
        }
        
        $prefix = substr($term[1], 0, $pref_length);
        $number = substr($term[1], $pref_length, 4);    
        
        print "$subject $prefix$number\n";

        $repo = $this->em->getRepository('src\course_lookup\Entity\Course');
        $result = $repo->find_course($subject, $prefix, $number);
        return $result->getArrayResult();
    }
}

?>
