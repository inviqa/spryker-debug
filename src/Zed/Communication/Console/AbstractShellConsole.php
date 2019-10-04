<?php

namespace Inviqa\SprykerDebug\Zed\Communication\Console;

use RuntimeException;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Process\ExecutableFinder;

class AbstractShellConsole extends Console
{
    protected function resolveShellPath(string $shellName): string
    {
        if (file_exists($shellName)) {
            return $shellName;
        }

        $path = (new ExecutableFinder())->find($shellName);

        if ($path === null) {
            throw new RuntimeException(sprintf(
                'Shell "%s" not found, maybe you need to install it?',
                $shellName
            ));
        }

        return $path;
    }
}
