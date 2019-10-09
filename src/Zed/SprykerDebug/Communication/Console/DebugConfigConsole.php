<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Inviqa\Zed\SprykerDebug\Communication\Model\Config\ConfigTypeExtractingConfig;
use ReflectionClass;
use Spryker\Shared\Config\Config;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DebugConfigConsole extends Console
{
    public const NAME = 'debug:config';
    public const DESCRIPTION = 'Inspect the current Spryker configuration';
    public const ARGUMENT_FILTER = 'filter';

    public function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription(self::DESCRIPTION);
        $this->addArgument(self::ARGUMENT_FILTER, InputArgument::OPTIONAL, 'Regex filter');
        $this->addOption('origin', null, InputOption::VALUE_REQUIRED, 'Filter origin');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->extractConfiguration();
        $config = $this->filterConfig(
            $config,
            Cast::toStringOrNull($input->getArgument(self::ARGUMENT_FILTER))
        );
        $config = $this->sortConfiguration($config);
        $config = $this->addOrigin($config);
        $config = $this->filterOrigin($config, Cast::toStringOrNull($input->getOption('origin')));

        $this->renderTable($output, $config);
    }

    private function extractConfiguration(): array
    {
        $config = Config::getInstance();
        $reflection = new ReflectionClass(get_class($config));
        $configProperty = $reflection->getProperty('config');
        $configProperty->setAccessible(true);
        $config = $configProperty->getValue($config);
        $config = iterator_to_array($config);

        return $config;
    }

    private function sortConfiguration(array $config): array
    {
        ksort($config);

        return $config;
    }

    private function renderTable(OutputInterface $output, array $config): void
    {
        $table = new Table($output);
        $table->setHeaders([
            'Key',
            'Value',
            'Origin',
        ]);

        foreach ($config as $entry) {
            $table->addRow([
                sprintf('<info>%s</>', $entry['key']),
                $this->serializeValue($entry['value']),
                $entry['origin'],
            ]);
        }
        $table->render();
    }

    private function filterConfig($config, ?string $filter): array
    {
        if ($filter === null) {
            return $config;
        }

        $config = array_filter($config, function (string $key) use ($filter) {
            return preg_match('{' . $filter . '}i', $key);
        }, ARRAY_FILTER_USE_KEY);

        return $config;
    }

    private function serializeValue($value): string
    {
        if (!is_scalar($value)) {
            $value = json_encode($value, JSON_PRETTY_PRINT);
        }

        return Cast::toString($value);
    }

    private function addOrigin($config): array
    {
        $typeMap = (new ConfigTypeExtractingConfig())();

        return array_map(function ($key, $value) use ($typeMap) {
            return [
                'key' => $key,
                'value' => $value,
                'origin' => isset($typeMap[$key]) ? basename($typeMap[$key]) : '<default>',
            ];
        }, array_keys($config), array_values($config));
    }

    private function filterOrigin(array $config, ?string $filter): array
    {
        if ($filter === null) {
            return $config;
        }

        return array_filter($config, function (array $entry) use ($filter) {
            return preg_match('{' . $filter . '}i', $entry['origin']);
        });
    }
}
