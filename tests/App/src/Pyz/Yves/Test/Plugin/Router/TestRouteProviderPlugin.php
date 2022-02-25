<?php

namespace Pyz\Yves\Test\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

final class TestRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/', 'Test', 'Index', 'index');

        $routeCollection->add('home', $route);

        return $routeCollection;
    }
}
