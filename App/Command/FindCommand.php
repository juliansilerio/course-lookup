<?php

namespace App\Command;

use App\Service\FindService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\Table;

class FindCommand extends AbstractCommand {

    protected function configure () {
        $this
            ->setName('find')
            ->setDescription('find a course based on a word in its name')
            ->addArgument(
                'word',
                InputArgument::REQUIRED,
                'find a course based on its name'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $word = $input->getArgument('word');

        if($word) {
            $find = new FindService($this->em);
            $result = $find->find_word($word);
        }

        if(!$result) {
            $output->writeln("<error>The word $call_number was not found in the name of a course </error>");
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
