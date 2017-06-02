<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;

class StatsService {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em=$em;
    }

    public function most_courses() {
        $repo = $this->em->getRepository('App\Entity\Course');
        $result = $repo->most_courses();
        return $result->getArrayResult();
    }

     public function most_used_words() {
        $repo = $this->em->getRepository('App\Entity\Course');
        $result = $repo->most_used_words();
        
        $words = array();
        $array = $result->getArrayResult();
        foreach($array as $row) {
            print $row[1]."\n";            
            $strings = explode(" ", strtolower($row));
            
            foreach($strings as $string) {
                print $string."\n";
                if(!array_key_exists($string, $words)) {
                    $words[$string] = 1;
                } else {
                    $words[$string] = $words[$string] + 1;   
                }
            } 
        }   
        arsort($words);
        

        return $words;
    }   


}

?>
