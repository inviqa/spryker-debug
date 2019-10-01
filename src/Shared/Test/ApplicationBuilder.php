<?php

namespace Inviqa\Spryker\Debug\Shared\Test;

use RuntimeException;
use Spryker\Shared\Application\Application;
use Spryker\Zed\Application\Communication\ZedBootstrap;
use Spryker\Zed\Propel\Communication\Plugin\ServiceProvider\PropelServiceProvider;

class ApplicationBuilder
{
    private const ENV_DEVTEST = 'devtest';

    /**
     * @var string
     */
    private $app;

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

    /**
     * @var bool
     */
    private $enablePropel;

    private function __construct(string $rootDir, string $store, string $app)
    {
        $this->app = $app;
        $this->rootDir = $rootDir;
        $this->store = $store;
    }

    public static function create(string $rootDir, string $store, string $app = 'ZED'): self
    {
        return new self($rootDir, $store, $app);
    }

    public function applicationEnv(string $env): self
    {
        $this->env = $env;
        return $this;
    }

    public function enablePropel(): self
    {
        $this->enablePropel = true;
        return $this;
    }

    public function build(): Application
    {
        $this->defineIfNotSet('APPLICATION', $this->resolveApp());
        $this->defineIfNotSet('APPLICATION_ROOT_DIR', $this->resolveRootDir());
        $this->defineIfNotSet('APPLICATION_ENV', $this->resolveEnv());
        $this->defineIfNotSet('APPLICATION_STORE', $this->store);
        $this->defineIfNotSet('APPLICATION_VENDOR_DIR', __DIR__ . '/../../../vendor');

        $bootstrap = new ZedBootstrap();
        $application = $bootstrap->boot();

        return $application;
    }

    private function resolveApp(): string
    {
        return strtoupper($this->app);
    }

    private function resolveRootDir(): string
    {
        if (!file_exists($this->rootDir)) {
            throw new RuntimeException(sprintf(
                'Root Directory "%s" does not exist',
                $this->rootDir
            ));
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
}
