<?php

require __DIR__.'/vendor/autoload.php';

use src\course_lookup\Command\ImportCommand;
use src\course_lookup\Command\LookupCommand;
use src\course_lookup\Command\StatsCommand;
use src\course_lookup\Command\ColumnLookupCommand;
use src\course_lookup\Command\FindCommand;
use src\course_lookup\Command\AdvLookupCommand;
use src\course_lookup\Command\CourseLevelsCommand;
use Symfony\Component\Console\Application;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;


$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__. '/db.sqlite',);

$em = EntityManager::create($conn, $config);

$application = new Application();
$application->add(new ImportCommand($em));
$application->add(new LookupCommand($em));
$application->add(new StatsCommand($em));
$application->add(new ColumnLookupCommand($em));
$application->add(new FindCommand($em));
$application->add(new AdvLookupCommand($em));
$application->add(new CourseLevelsCommand($em));
$application->run();

?>
