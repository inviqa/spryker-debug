<?php

namespace Inviqa\SprykerDebug\Tests\Support\Workspace;

use RuntimeException;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

class Workspace
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->filesystem = new Filesystem();
    }

    public static function create(): self
    {
        return new self(__DIR__ . '/../Workspace');
    }

    public function reset(): void
    {
        if (file_exists($this->path)) {
            $this->filesystem->remove($this->path);
        }

        $this->filesystem->mkdir($this->path);
    }

    public function ensureExists(): void
    {
        if (file_exists($this->path)) {
            return;
        }

        $this->filesystem->mkdir($this->path);
    }

    public function path(string $relative = '/'): string
    {
        return Path::join($this->path, $relative);
    }

    public function put(string $path, string $contents): void
    {
        $path = $this->path($path);
        if (!file_exists(dirname($path))) {
            $this->filesystem->mkdir(dirname($path));
        }

        file_put_contents($path, $contents);
    }

    public function copy(string $absoluteSource, string $relativeDest)
    {
        if (Path::isAbsolute($relativeDest)) {
            throw new RuntimeException(
                sprintf(
                    'Cannot copy file to an absolute path "%s" in a workspace',
                    $relativeDest
                )
            );
        }

        if (Path::isAbsolute($absoluteSource) === false) {
            throw new RuntimeException(
                sprintf(
                    'Cannot copy file from a relative path "%s" in a workspace',
                    $absoluteSource
                )
            );
        }

        if (file_exists($absoluteSource) === false) {
            throw new RuntimeException(
                sprintf(
                    'File "%s" does not exist',
                    $absoluteSource
                )
            );
        }

        $this->filesystem->copy($absoluteSource, $this->path($relativeDest));
    }
}
