<?php

namespace src\course_lookup\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * course-lookup\App\Entity\Course
 *
 * @Entity(repositoryClass="CourseRepository")
 * @Table(name="course")
 *
 *
 */


class Course {
    
    /** @ID @Column(type="integer") @GeneratedValue **/
    protected $id;
    
    /** @Column(type="string") **/
    protected $department;
        
    /** @Column(type="string") **/
    protected $subject;
 
    /** @Column(type="string") **/
    protected $bulletin_prefix;

    /** @Column(type="integer") **/
    protected $course_number;

    /** @Column(type="string") **/
    protected $name;
    
    /** @Column(type="integer") **/
    protected $points_min;
    
    /** @Column(type="integer") **/
    protected $points_max;
    
    /**
     *  @param string $department
     */
    public function set_department($department) {
        $this->department = $department;
    }
    
     
    /**
     *  @param string $department
     */
    public function set_subject($subject) {
        $this->subject = $subject;
    }
    
     
    /**
     *  @param string $bulletin_prefix
     */
    public function set_bulletin_prefix($bulletin_prefix) {
        $this->bulletin_prefix = $bulletin_prefix;
    }
    
     
    /**
     *  @param int $course_number
     */
    public function set_course_number($course_number) {
        $this->course_number = $course_number;
    }    
    
     
    /**
     *  @param string $name
     */
    public function set_name($name) {
        $this->name = $name;
    }    
    
     
    /**
     *  @param int $points_min
     */
    public function set_points_min($points_min) {
        $this->points_min = $points_min;
    }    
    
     
    /**
     *  @param int $points_max
     */
    public function set_points_max($points_max) {
        $this->points_max = $points_max;
    }
 
    /**
     *  @return string
     */
    public function get_department() {
        return $this->department;
    }
    
    /**
     *  @return string
     */
    public function get_subject() {
        return $this->subject;
    }
    
    /**
     *  @return string
     */
    public function get_bulletin_prefix() {
        return $this->bulletin_prefix;
    }
    
    /**
     *  @return int
     */
    public function get_course_number() {
        return $this->course_number;
    }    
    
    /**
     *  @return string
     */
    public function get_name() {
        return $this->name;
    }    
    
    /**
     *  @return int
     */
    public function get_points_min() {
        return $this->points_min;
    }    
    
    /**
     *  @return int
     */
    public function get_points_max() {
        return  $this->points_max;
    }
}


?>
