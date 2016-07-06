<?php

use Album\AlbumMiddleware;
use Album\AlbumMiddlewareFactory;
use Zend\Expressive\Container\ApplicationFactory;

return [
    /**
     * Configuration to the AlbumMiddleware. It follows the same scheme as the global expressive app.
     */
    'album_middleware' => [
        'basePath' => '', // Default, global expressive app overwrites this in `middleware-pipeline.global.php`
        'routes' => [
            [
                'name' => 'album.list',
                'path' => '/album/',
                'middleware' => \Album\Action\AlbumCollection::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'album.entity',
                'path' => '/album/{id:\d+}/',
                'middleware' => \Album\Action\AlbumEntity::class,
                'allowed_methods' => ['GET'],
            ],
        ],
        'middleware_pipeline' => [
            'routing' => [
                'priority' => 1,
                'middleware' => [
                    ApplicationFactory::ROUTING_MIDDLEWARE,
                    \Album\AlbumUrlHelperMiddleware::class,
                    ApplicationFactory::DISPATCH_MIDDLEWARE,
                ],
            ],
        ],
    ],

    'dependencies' => [
        'invokables' => [
            \Album\AlbumRouter::class => \Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            AlbumMiddleware::class => AlbumMiddlewareFactory::class,
            \Album\Action\AlbumCollection::class => \Album\Action\AlbumCollectionFactory::class,
            \Album\Action\AlbumEntity::class => \Album\Action\AlbumEntityFactory::class,
            \Album\AlbumUrlHelper::class => \Album\AlbumUrlHelperFactory::class,
            \Album\AlbumUrlHelperMiddleware::class => \Album\AlbumUrlHelperMiddlewareFactory::class,
        ],
    ],

    'doctrine' => [
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'Album\Entity' => 'album_entity',
                ],
            ],
            'album_entity' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'paths' => __DIR__ . '/../src/Entity/',
                'cache' => 'array',
            ],
        ],
    ],
];