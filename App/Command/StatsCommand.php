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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $stats = new StatsService($this->em);
        $most_courses = $stats->most_courses();
        $most_used_words = $stats->most_used_words();

        $this->make_table($output, $most_courses, array('Academic Department', 'Number of Courses'), 5);
        $this->make_table($output, $most_used_words, array('Word', 'Frequency'), 10);        

    }

    protected function make_table(OutputInterface $output, array $results, array $headers, $count) {
        $table = new Table($output);
        $table
            ->setHeaders($headers);

        for($i = 0; $i < $count; $i++) {
            //array_shift($results[$i]);
            $table->addRow($results[$i]);
        }

        $table->render();
    }
}


?>
