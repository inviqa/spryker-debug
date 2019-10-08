<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class RouteDebugConsole extends Console
{
    protected function configure()
    {
        $this->setName('debug:routes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $routes = $this->getFactory()->createRouteLoader()->load();
        $table = new Table($output);
        $table->setHeaders([
            'Name',
            'Method',
            'Scheme',
            'Host',
            'Path',
        ]);
        $table->setStyle('borderless');

        /** @var Route $route */
        foreach ($routes as $name => $route) {
            $table->addRow([
                $name,
                implode(', ', $route->getMethods() ?: ['ANY']),
                implode(', ', $route->getSchemes() ?: ['ANY']),
                $route->getHost() ?: 'ANY',
                $route->getPath(),
            ]);
        }

        $table->render();
    }
}
