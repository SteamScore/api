<?php
use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require 'config/container.php';

/** @var Application $app */
$app = $container->get(Application::class);

$app->run();
