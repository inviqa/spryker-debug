<?php

namespace InviqaSprykerDebug\Shared\Config;

use InviqaSprykerDebug\Shared\Config\Exception\InvalidConfigException;

class ArrayLoader
{
    public static function create(): self
    {
        return new self();
    }

    public function load(array $config, array $fqnParts = [])
    {
        $fqn = implode('\\', $fqnParts);
        $checkConstant = false;

        if (interface_exists($fqn) || class_exists($fqn)) {
            $checkConstant = true;
        }

        $resolved = [];

        foreach ($config as $key => $value) {
            if ($checkConstant) {
                $resolved[constant($fqn . '::' . $key)] = $value;
                continue;
            }

            if (is_array($value)) {
                $newFqnParts = $fqnParts;
                $newFqnParts[] = $key;
                $resolved = array_merge($resolved, $this->load($value, $newFqnParts));
                continue;
            }

            throw new InvalidConfigException(
                sprintf(
                    'Could not resolve "%s"',
                    $fqn
                )
            );
        }

        return $resolved;
    }
}
