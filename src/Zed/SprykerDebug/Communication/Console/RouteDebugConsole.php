<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;
use function Safe\json_decode;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class RouteDebugConsole extends Console
{
    private const OPT_SHOW_DEFAULTS = 'defaults';
    private const OPT_SHOW_REQUIREMENTS = 'requirements';
    private const OPT_SHOW_CONDITION = 'condition';

    protected function configure()
    {
        $this->setName('debug:routes');
        $this->addOption(self::OPT_SHOW_DEFAULTS, null, InputOption::VALUE_NONE, 'Show defaults (including controller)');
        $this->addOption(self::OPT_SHOW_REQUIREMENTS, null, InputOption::VALUE_NONE, 'Show requirements');
        $this->addOption(self::OPT_SHOW_CONDITION, null, InputOption::VALUE_NONE, 'Show condition');
        $this->setDescription('List all routes or debug a specific route');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $routes = $this->getFactory()->createRouteLoader()->load();
        $table = new Table($output);
        $table->setHeaders($this->resolveHeader($input));
        $table->setStyle('borderless');

        foreach ($routes as $name => $route) {
            assert($route instanceof Route);
            $table->addRow($this->resolveRow($input, $name, $route));
        }

        $table->render();
    }

    private function resolveHeader(InputInterface $input): array
    {
        $header = [
            'Name',
            'Method',
            'Scheme',
            'Host',
            'Path',
        ];

        if ($input->getOption(self::OPT_SHOW_DEFAULTS)) {
            $header[] = 'Defaults';
        }

        if ($input->getOption(self::OPT_SHOW_REQUIREMENTS)) {
            $header[] = 'Requirements';
        }

        if ($input->getOption(self::OPT_SHOW_CONDITION)) {
            $header[] = 'Condition';
        }

        return $header;
    }

    private function resolveRow(InputInterface $input, $name, Route $route): array
    {
        $row = [
            $name,
            implode(', ', $route->getMethods() ?: ['ANY']),
            implode(', ', $route->getSchemes() ?: ['ANY']),
            $route->getHost() ?: 'ANY',
            $route->getPath()
        ];

        if ($input->getOption(self::OPT_SHOW_DEFAULTS)) {
            try {
                $row[] = json_encode($route->getDefaults());
            } catch (Exception $e) {
                $row[] = sprintf('<error>%s</error>', $e->getMessage());
            }
        }

        if ($input->getOption(self::OPT_SHOW_REQUIREMENTS)) {
            try {
                $row[] = json_encode($route->getRequirements());
            } catch (Exception $e) {
                $row[] = sprintf('<error>%s</error>', $e->getMessage());
            }
        }

        if ($input->getOption(self::OPT_SHOW_CONDITION)) {
            $row[] = $route->getCondition();
        }

        return $row;
    }
}
