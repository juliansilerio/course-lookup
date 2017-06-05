<?php

namespace App\Command;

use App\Service\DeptLookupService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class DeptLookupCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('dept lookup')
            ->setDescription('look up courses in a department')
            ->addArgument(
                'department',
                InputArgument::REQUIRED,
                'look up courses based on a department'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $department = $input->getArgument('department');

        if($department) {
            $lookup = new DeptLookupService($this->em);
            $result = $lookup->department_lookup($department);
        }

        if(!$result) {
            $output->writeln("<error>The department $department was not found </error>");
        } else {
            $this->make_table($output, $result);
        }
    }

    protected function make_table(OutputInterface $output, array $results) {
        $table = new Table($output);
        $table
            ->setHeaders(array('Academic Department', 'Subject Area', 'School Bulletin Prefix', 'Course Number', 'Name', 'Min Points', 'Max Points'));

        foreach($results as $result) {
            array_shift($result);
            $table->addRow($result);
        }

        $table->render();
    }
}


?>
