<?php

namespace Inviqa\Yves\SprykerDebug\Controller;

use Silex\Route;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class RouteApiController extends AbstractController
{
    public function indexAction()
    {
        $routeCollection = $this->getApplication()['routes'];
        $serialized = [];

        foreach ($routeCollection as $route) {
            assert($route instanceof Route);
            $serialized[] = [
                'condition' => $route->getCondition(),
                'host' => $route->getHost(),
                'defaults' => $route->getDefaults(),
                'methods' => $route->getMethods(),
                'options' => $route->getOptions(),
                'path' => $route->getPath(),
                'requirements' => $route->getRequirements(),
                'schemes' => $route->getSchemes(),
            ];
        }

        return new JsonResponse($serialized);
    }
}
