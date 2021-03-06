<?php

namespace src\course_lookup\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;

abstract class AbstractCommand extends Command {
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        parent::__construct();
    }
}

?>
