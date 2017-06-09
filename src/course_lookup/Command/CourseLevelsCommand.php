<?php

namespace src\course_lookup\Command;

use src\course_lookup\Service\CourseLevelsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class CourseLevelsCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('course_levels')
            ->setDescription('course_levels for allthe departments')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $stats = new CourseLevelsService($this->em);
        
        $number_course_levels = $stats->number_course_levels();

        $this->make_table_vspan($output, $number_course_levels, array('Department', 'Course level', 'Number of courses')); 
    }
    
    protected function make_table_all(OutputInterface $output, array $results, array $headers) {
        $table = new Table($output);
        $table
            ->setHeaders($headers);
        foreach($results as $row) {
            $table->addRow($row);
        }

        $table->render();
    }

    protected function make_table_vspan(OutputInterface $output, array $results, array $headers) {
        $table = new Table($output);
        $table
            ->setHeaders($headers);
        $size = count($results);
        
        for($i = 0; $i < $size; $i++) {
            $row = $results[$i];
            
            if($i !== 0 && $results[$i]['department'] === $results[$i-1]['department']) {
                $row = array('', $results[$i]['start'], $results[$i]['count(*)']);
            } 
            
            $table->addRow($row);
            
            if($i !== ($size-1) && $results[$i]['department'] !== $results[$i+1]['department']) {
                $table->addRow(new TableSeparator());    
            }
        }

        $table->render();
    }

}
?>
