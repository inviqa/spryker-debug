<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Bridge\Twig\Extension\DumpExtension;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Twig_Environment;

/**
 * @method \Pyz\Yves\Development\DevelopmentConfig getConfig()
 */
class TwigVarDumpServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app->extend('twig', function (Twig_Environment $twig) {
            $dumper = new VarCloner();
            $twig->addExtension(new DumpExtension($dumper));

            return $twig;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
