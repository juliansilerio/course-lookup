<?php

namespace src\course_lookup\Command;

use src\course_lookup\Service\ColumnLookupService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class ColumnLookupCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('column')
            ->setDescription('look up courses by a certain column filter')
            ->addArgument(
                'column',
                InputArgument::REQUIRED,
                'look up courses based on a column'
            )
            ->addArgument(
                'arg',
                InputArgument::REQUIRED,
                'what to search column against'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $column = $input->getArgument('column');
        $argument = $input->getArgument('arg');
 
        if($column) {
            $lookup = new ColumnLookupService($this->em);
            $result = $lookup->column_lookup($column, $argument);
        }

        if(!$result) {
            $output->writeln("<error>The column '$column' or argument '$argument'  was not found </error>");
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
