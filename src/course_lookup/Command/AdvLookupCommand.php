<?php

namespace src\course_lookup\Command;

use src\course_lookup\Service\AdvLookupService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class AdvLookupCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('adv_lookup')
            ->setDescription('look up courses based on department and course level')
            ->addArgument(
                'department',
                InputArgument::REQUIRED,
                'department in which to search'
            )
             ->addArgument(
                'subject',
                InputArgument::OPTIONAL,
                'subject in which to search'
            )           
            ->addArgument(
                'course level',
                InputArgument::OPTIONAL,
                'course level in which to search'
            )

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $department = $input->getArgument('department');
        $course_level = $input->getArgument('course level');
        $subject = $input->getArgument('subject');

        if($department) {
            $lookup = new AdvLookupService($this->em);
            //print "$department $course_level $subject \n";
            $result = $lookup->adv_lookup_course($department, $course_level, $subject);
        } 
            

        if(!$result) {
            $output->writeln("<error>Courses within department $department were not found </error>");
        } else {
            $this->make_table($output, $result);
        }
    }

    protected function make_table(OutputInterface $output, array $results) {
        $table = new Table($output);
        $table
            ->setHeaders(array('Academic Department', 'Subject Area', 'Bulletin Prefix', 'Course Number', 'Name', 'Min Points', 'Max Points'));

        foreach($results as $result) {
            array_shift($result);
            $table->addRow($result);
        }

        $table->render();
    }
}


?>
