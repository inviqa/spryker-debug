<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Route;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use function Safe\json_decode;

class RouteLoader
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function load(): RouteCollection
    {
        return $this->loadRoutes();
    }

    private function loadRoutes(): RouteCollection
    {
        $response = $this->client->get('/spryker-debug/routes');
        $routes = json_decode($response->getBody()->__toString(), true);
        $collection = new RouteCollection();

        foreach ($routes as $name => $route) {
            $collection->add($name, new Route(
                $route['path'],
                $route['defaults'],
                $route['requirements'],
                [],
                $route['host'],
                $route['schemes'],
                $route['methods'],
                $route['condition']
            ));
        }

        return $collection;
    }
}
