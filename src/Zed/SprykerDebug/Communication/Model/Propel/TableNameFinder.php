<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Propel;

use DOMDocument;
use DOMXPath;
use Inviqa\Zed\SprykerDebug\Model\Propel\PropelConfig;
use Propel\Generator\Model\PhpNameGenerator;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class TableNameFinder
{
    /**
     * @var \Inviqa\Zed\SprykerDebug\Model\Propel\PropelConfig
     */
    private $config;

    /**
     * @var \Propel\Generator\Model\PhpNameGenerator
     */
    private $nameGenerator;

    public function __construct(PropelConfig $config)
    {
        $this->config = $config;
        $this->nameGenerator = new PhpNameGenerator();
    }

    public function findEntityNames(): array
    {
        $finder = new Finder();
        $finder->in($this->config->schemaDir());
        $finder->name('*.xml');

        return array_reduce(iterator_to_array($finder), function ($names, SplFileInfo $info) {
            return array_merge($names, $this->extractTableNames($info->getPathname()));
        }, []);
    }

    private function extractTableNames(string $schemaPath): array
    {
        $names = [];

        $dom = new DOMDocument('1.0');
        $dom->load($schemaPath);
        $entityNamespace = '';
        $entityNamespaceAttr = $dom->firstChild->attributes->getNamedItem('namespace');
        if ($entityNamespaceAttr) {
            $entityNamespace .= $entityNamespaceAttr->nodeValue;
        }

        // spryker does not seem to have consistent XML namespace
        foreach (
            [
            'sprk' => 'spryker:schema-01',
            '' => '',
            ] as $alias => $namespace
        ) {
            $xpath = new DOMXPath($dom);
            if ($namespace) {
                $xpath->registerNamespace($alias, $namespace);
                $alias .= ':';
            }

            foreach ($xpath->query('//' . $alias . 'table') as $tableEl) {
                $names[] = implode([
                    $entityNamespace,
                    '\\',
                    $this->nameGenerator->generateName([
                        $tableEl->attributes->getNamedItem('name')->value,
                        PhpNameGenerator::CONV_METHOD_PHPNAME,
                    ]),
                ]);
            }
        }

        return $names;
    }
}
