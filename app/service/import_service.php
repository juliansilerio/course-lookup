<?php

namespace app\service;

use Doctrine\ORM\EntityManager;

class ImportService {
    protected $filename = "";
    //protected $out;
    protected $em;

    public function __construct($filename, EntityManager $em) {
        $this->filename = $filename;
        $this->out = $out;
        $this->em = $em;
    }

    public function process_csv() {
        $file = fopen($filename);
        while(($line=fgetcsv($file)) !== false) {
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

            $this->em->persist($course);
            $this->em->flush();
        }

        fclose($file);
           
    } 
