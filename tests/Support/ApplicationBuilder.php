<?php

namespace Inviqa\SprykerDebug\Tests\Support;

use RuntimeException;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Zed\Application\Communication\Bootstrap\BackofficeBootstrap;

class ApplicationBuilder
{
    private const ENV_DEVTEST = 'devtest';
    private const APP_ZED = 'ZED';
    private const APP_YVES = 'YVES';

    /**
     * @var string
     */
    private $app = self::APP_ZED;

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var string
     */
    private $store;

    /**
     * @var string
     */
    private $env;

    private function __construct(string $rootDir, string $store)
    {
        $this->rootDir = $rootDir;
        $this->store = $store;
    }

    public static function create(string $rootDir, string $store): self
    {
        return new self($rootDir, $store);
    }

    public function env(string $env): self
    {
        $this->env = $env;

        return $this;
    }

    public function forZed(): self
    {
        $this->app = self::APP_ZED;

        return $this;
    }

    public function forYves(): self
    {
        $this->app = self::APP_YVES;

        return $this;
    }

    public function build(): ContainerInterface
    {
        $this->defineIfNotSet('APPLICATION', $this->app);
        $this->defineIfNotSet('APPLICATION_ROOT_DIR', $this->resolveRootDir());
        $this->defineIfNotSet('APPLICATION_CODE_BUCKET', 'Foobar');
        $this->defineIfNotSet('APPLICATION_ENV', $this->resolveEnv());
        $this->defineIfNotSet('APPLICATION_STORE', $this->store);
        $this->defineIfNotSet('APPLICATION_VENDOR_DIR', __DIR__ . '/../../vendor');
        $this->defineIfNotSet('APPLICATION_SOURCE_DIR', APPLICATION_ROOT_DIR . '/src');

        return $this->resolveBootstrap()->boot();
    }

    private function resolveRootDir(): string
    {
        if (!file_exists($this->rootDir)) {
            throw new RuntimeException(
                sprintf(
                    'Root Directory "%s" does not exist',
                    $this->rootDir
                )
            );
        }

        return $this->rootDir;
    }

    private function resolveEnv(): string
    {
        if (!$this->env) {
            return self::ENV_DEVTEST;
        }
    }

    private function defineIfNotSet(string $string, $value): void
    {
        if (defined($string)) {
            return;
        }

        define($string, $value);
    }

    private function resolveBootstrap(): BackofficeBootstrap
    {
        return new BackofficeBootstrap();
    }
}
