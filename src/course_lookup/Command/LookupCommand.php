<?php

namespace src\course_lookup\Command;

use src\course_lookup\Service\LookupService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class LookupCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('lookup')
            ->setDescription('look up a course')
            ->addArgument(
                'call number',
                InputArgument::REQUIRED,
                'call number to reference'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $call_number = $input->getArgument('call number');

        if($call_number) {
            $lookup = new LookupService($this->em);
            $result = $lookup->lookup_course($call_number);
        }

        if(!$result) {
            $output->writeln("<error>The course $call_number was not found </error>");
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
