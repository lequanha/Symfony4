<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'cache.security_expression_language' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/AbstractTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/AbstractAdapter.php';

return $this->privates['cache.security_expression_language'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('wkXNMvO2L7', 0, $this->getParameter('container.build_id'), ($this->targetDirs[0].'/pools'), ($this->privates['monolog.logger.cache'] ?? $this->load('getMonolog_Logger_CacheService.php')));
