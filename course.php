<?php

require __DIR__.'/vendor/autoload.php';

use app\service\import_service;
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
$application->run();

?>
