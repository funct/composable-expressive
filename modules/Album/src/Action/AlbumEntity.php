<?php

namespace Album\Action;

use Album\AlbumUrlHelper;
use Doctrine\ORM\EntityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;

class AlbumEntity
{
    /**
     * @var EntityRepository
     */
    private $albumRepository;

    /**
     * @var AlbumUrlHelper
     */
    private $albumUrlHelper;

    public function __construct(EntityRepository $albumRepository, AlbumUrlHelper $albumUrlHelper)
    {
        $this->albumRepository = $albumRepository;
        $this->albumUrlHelper = $albumUrlHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $requestMethod = $request->getMethod();
        $routeMatch = $request->getAttribute(RouteResult::class);

        switch ($requestMethod) {
            case 'GET':
                return new JsonResponse($this->get($routeMatch->getMatchedParams()['id']));
                break;

            default:
                throw new \RuntimeException('Method not allowed', 405);
                break;
        }
    }

    public function get($id)
    {
        $album = $this->albumRepository->find($id);
        if (null === $album) {
            return null;
        }

        return [
            'id' => $album->getId(),
            'title' => $album->getTitle(),
            'year' => $album->getYear(),
            '_ref' => [
                '_self' => $this->albumUrlHelper->generate('album.entity', ['id' => $album->getId()]),
            ]
        ];
    }
}