<?php

namespace Pyz\Zed\Twig;

use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigLoaderPluginInterface;
use Spryker\Zed\Twig\TwigDependencyProvider as SprykerTwigDependencyProvider;
use Spryker\Shared\Twig\Loader\FilesystemLoaderInterface;
use Spryker\Shared\Twig\Loader\FilesystemLoader;

class TwigDependencyProvider extends SprykerTwigDependencyProvider
{
    protected function getTwigLoaderPlugins(): array
    {
        return [
            'workspace' => new class implements TwigLoaderPluginInterface {
                public function getLoader(): FilesystemLoaderInterface
                {
                    return new FilesystemLoader(APPLICATION_ROOT_DIR . '/../Support/Workspace');
                }
            },
        ];
    }
}
