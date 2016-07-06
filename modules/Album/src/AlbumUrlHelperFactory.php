<?php

namespace Album;

use Interop\Container\ContainerInterface;

class AlbumUrlHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['album_middleware'];
        $router = $container->get(AlbumRouter::class);

        $urlHelper = new AlbumUrlHelper($router);

        if (!empty($config['basePath'])) {
            $urlHelper->setBasePath($config['basePath']);
        }
        
        return $urlHelper;
    }
}