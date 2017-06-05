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
        foreach($array as $row) {                           # top level data containing entire table           
            foreach($row as $key => $string) {              # row data 
                $strings = explode(" ", strtolower($string));
                
                foreach($strings as $word) {
                    //print $word."\n";
                    if(!array_key_exists($word, $words)) {
                        $words[$word] = 1;
                    } else {
                        $words[$word] = $words[$word] + 1;   
                    }
                }   
            } 
        }   
        arsort($words);
        

        return $words;
    }   


}

?>
