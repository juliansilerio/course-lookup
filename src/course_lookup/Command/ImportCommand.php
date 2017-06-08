<?php

namespace src\course_lookup\Command;

use src\course_lookup\Service\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends AbstractCommand {
    
    protected function configure() {
        $this
            ->setName('import')
            ->setDescription('import a course csv')
            ->addArgument(
                'filepath',
                InputArgument::REQUIRED,
                'path to course csv'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $filename = $input->getArgument('filepath');

        if(file_exists($filename)) {
            $import = new ImportService($filename, $this->em);
            $import->process_csv();
            echo "$filename successfully imported\n";
            exit(1);
        } else {
            $output->writeln("<eror>File $filename does not exist!</error>");
            exit(1);
        }
    }
}


?>

