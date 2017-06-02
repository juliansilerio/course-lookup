<?php

namespace App\Service;

//use App\Entity\CourseRepository;
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

        $repo = $this->em->getRepository('App\Entity\Course');
        $result = $repo->find_course($subject, $prefix, $number);
        return $result->getArrayResult();
    }
}

?>
