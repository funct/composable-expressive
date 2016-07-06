<?php

use Zend\Expressive\ConfigManager\ConfigManager;
use Zend\Expressive\ConfigManager\PhpFileProvider;

/**
 * Packing everything inline so we do not pollute the global namespace
 */
return new ArrayObject(
    (new ConfigManager([
        /**
         * Module configuration comes first
         */
        \Album\ModuleConfig::class,

        /**
         * Let autoloaded configuration overwrite module configuration
         */
        new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
    ], 'data/cache/config-cache.php'))
    ->getMergedConfig()
);