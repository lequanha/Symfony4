<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'doctrine.dbal.default_connection.configuration' shared service.

include_once $this->targetDirs[3].'/vendor/doctrine/dbal/lib/Doctrine/DBAL/Configuration.php';

return $this->privates['doctrine.dbal.default_connection.configuration'] = new \Doctrine\DBAL\Configuration();
