<?php

namespace Album;

class ModuleConfig
{
    public function __invoke()
    {
        return require __DIR__ . '/../config/module.config.php';
    }
}