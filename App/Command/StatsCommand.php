<?php

namespace App\Command;

use App\Service\StatsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class StatsCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('stats')
            ->setDescription('general stats for the courses')
            ->addArgument(
                'excluded',
                InputArgument::OPTIONAL,
                'Words to exclude from most used'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $stats = new StatsService($this->em);
        
        $excluded = array();
        if($input->getArgument('excluded')) {
            $excluded = explode(",", preg_replace('/\s+/', '', $input->getArgument('excluded')));
        } else {
            $excluded = array("the", "and", "in", "of", "to", "&");
        }       
        
        $most_courses = $stats->most_courses();
        $most_used_words = $stats->most_used_words();

        $this->make_table_index($output, $most_courses, array('Academic Department', 'Number of Courses'), 5);
        $this->make_table_assoc($output, $most_used_words, array('Word', 'Frequency'), 10, $excluded);        

    }

    protected function make_table_index(OutputInterface $output, array $results, array $headers, $count) {
        $table = new Table($output);
        $table
            ->setHeaders($headers);
        
        for($i = 0; $i < $count; $i++) {
            //array_shift($results[$i]);
            $table->addRow($results[$i]);
        }

        $table->render();
    }

    protected function make_table_assoc(OutputInterface $output, array $results, array $headers, $count, $excluded) {
        $table = new Table($output);
        $table
            ->setHeaders($headers);
    
        $counter = 0;
        while($counter < $count) {
            $items = each($results);
            $temp_array = array();
            for($i = 0; $i < count($headers); $i++) {
                array_push($temp_array, $items[$i]);
            }

            if(!in_array($temp_array[0], $excluded)) { 
                $table->addRow($temp_array);
                $counter++;   
            }
        }

        $table->render();
    }

}
?>
