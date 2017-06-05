<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\ImportCommand;
use App\Command\LookupCommand;
use App\Command\StatsCommand;
use App\Command\ColumnLookupCommand;
use App\Command\FindCommand;
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
$application->run();

?>
