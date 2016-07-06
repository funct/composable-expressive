<?php

namespace Album\Action;

use Album\Entity\Album;
use Doctrine\ORM\EntityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouteResult;

class AlbumCollection
{
    /**
     * @var EntityRepository
     */
    private $albumRepository;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(EntityRepository $albumRepository, UrlHelper $urlHelper)
    {
        $this->albumRepository = $albumRepository;
        $this->urlHelper = $urlHelper;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $requestMethod = $request->getMethod();

        switch ($requestMethod) {
            case 'GET':
                return new JsonResponse($this->listAllAction());
            break;

            default:
                throw new \RuntimeException('Method not allowed', 405);
            break;
        }
    }

    public function listAllAction()
    {
        /**
         * @var $albums Album[]
         */
        $albums = $this->albumRepository->findAll();
        $result = [];
        foreach ($albums as $album) {
            $result[] = [
                'id' => $album->getId(),
                'title' => $album->getTitle(),
                'year' => $album->getYear(),
                '_ref' => [
                    '_self' => $this->urlHelper->generate('album.entity', ['id' => $album->getId()]),
                ]
            ];
        }

        return $result;
    }
}