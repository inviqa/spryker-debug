<?php

namespace Pyz\Zed\Twig;

use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigLoaderPluginInterface;
use Spryker\Zed\Twig\TwigDependencyProvider as SprykerTwigDependencyProvider;
use Twig\Loader\FilesystemLoader;

class TwigDependencyProvider extends SprykerTwigDependencyProvider
{
    protected function getTwigLoaderPlugins(): array
    {
        return [
            'workspace' => new class implements TwigLoaderPluginInterface {
                public function getLoader(): FilesystemLoaderInterface {
                    return new FilesystemLoader(__DIR__ . '/../../../Workspace');
                }
            }
        ];
    }
}
