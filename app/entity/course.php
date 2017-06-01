<?php
namespace app\entity;

use Doctrine\ORM\Mapping as ORM;

class Course {
    protected $department;
    
    protected $subject;

    protected $bulletin_prefix;

    protected $course_number;

    protected $name;

    protected $points_min;

    protected $points_max;

    public function set_department($department) {
        $this->department = $department;
    }
    
    public function set_subject($subject) {
        $this->subject = $subject;
    }
    
    public function set_bulletin_prefix($bulletin_prefix) {
        $this->bulletin_prefix = $bulletin_prefix;
    }
    
    public function set_course_number($course_number) {
        $this->course_number = $course_number;
    }    
    
    public function set_name($name) {
        $this->name = $name;
    }    
    
    public function set_points_min($set_points_min) {
        $this->points_min = $points_min;
    }    
    
    public function set_points_max($points_max) {
        $this->points_max = $points_max;
    }

    public function get_department() {
        return $this->department;
    }
    
    public function get_subject() {
        return $this->subject;
    }
    
    public function get_bulletin_prefix() {
        return $this->bulletin_prefix;
    }
    
    public function get_course_number() {
        return $this->course_number;
    }    
    
    public function get_name() {
        return $this->name;
    }    
    
    public function get_points_min() {
        return $this->points_min;
    }    
    
    public function get_points_max() {
        return  $this->points_max;
    }
}


?>
