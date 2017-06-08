<?php

namespace src\course_lookup\Service;

use src\course_lookup\Entity\Course;
use Doctrine\ORM\EntityManager;

class ImportService {
    protected $filename = "";
    //protected $out;
    protected $em;

    public function __construct($filename, EntityManager $em) {
        $this->filename = $filename;
        //$this->out = $out;
        $this->em = $em;
    }

    public function process_csv() {
        $file = fopen($this->filename, 'r');
        
        echo $total=count(file($this->filename)) . "\n";
        $counter = 0;
        
        $batch_size = 20;
        while($line=fgetcsv($file)) {
            $department = $line[0];
            $subject = $line[1];
            $prefix = $line[2];
            $course_number = $line[3];
            $name = $line[4];
            $points_min = $line[5];
            $points_max = $line[6];               
            
            $course = new Course();
            $course->set_department($department);
            $course->set_subject($subject);
            $course->set_bulletin_prefix($prefix);
            $course->set_course_number($course_number);
            $course->set_name($name);
            $course->set_points_min($points_min);
            $course->set_points_max($points_max);

            $counter++;
            $percent = $counter/$total*100;
            echo $percent . "%\r";
            
            $this->em->persist($course);
            if(($counter % $batch_size) === 0) {
                $this->em->flush();
                $this->em->clear();
            }
        }

        $this->em->flush();
        $this->em->clear();

        fclose($file);
           
    }
} 
?>
