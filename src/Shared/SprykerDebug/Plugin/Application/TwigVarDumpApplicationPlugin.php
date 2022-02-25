<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Application;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface;
use Symfony\Bridge\Twig\Extension\DumpExtension;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Twig\Environment;

class TwigVarDumpApplicationPlugin implements ApplicationPluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function provide(ContainerInterface $container): ContainerInterface
    {
        $container->extend('twig', function (Environment $twig) {
            $dumper = new VarCloner();
            $twig->addExtension(new DumpExtension($dumper));

            return $twig;
        });

        return $container;
    }
}
