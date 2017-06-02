<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;

class LookupService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function lookupCourse($call_number) {
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
    }
}

?>
