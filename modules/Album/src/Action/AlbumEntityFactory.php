<?php

namespace Album\Action;

use Album\AlbumUrlHelper;
use Album\Entity\Album;
use Interop\Container\ContainerInterface;

class AlbumEntityFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        $albumRepository = $entityManager->getRepository(Album::class);
        $urlHelper = $container->get(AlbumUrlHelper::class);

        return new AlbumEntity($albumRepository, $urlHelper);
    }
}