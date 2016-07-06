<?php

namespace Album;

use Interop\Container\ContainerInterface;

class AlbumUrlHelperMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AlbumUrlHelperMiddleware($container->get(AlbumUrlHelper::class));
    }
}