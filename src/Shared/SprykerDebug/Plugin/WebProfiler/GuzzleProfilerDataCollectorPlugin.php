<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\WebProfiler;

use Inviqa\Shared\SprykerDebug\Plugin\WebProfiler\Guzzle\GuzzleProfilerDataCollector;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\WebProfilerExtension\Dependency\Plugin\WebProfilerDataCollectorPluginInterface;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class GuzzleProfilerDataCollectorPlugin implements WebProfilerDataCollectorPluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'Guzzle Profiler';
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplateName(): string
    {
        return '@SprykerDebug/collector/guzzle.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function getDataCollector(ContainerInterface $container): DataCollectorInterface
    {
        return $container->get(GuzzleProfilerDataCollector::class);
    }

}
