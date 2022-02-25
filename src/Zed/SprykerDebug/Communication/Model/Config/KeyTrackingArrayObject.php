<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Config;

use ArrayObject;

class KeyTrackingArrayObject extends ArrayObject
{
    /**
     * @var array
     */
    private $map = [];

    /**
     * @param int|string $index
     * @param mixed $value
     */
    public function offsetSet($index, $value): void
    {
        parent::offsetSet($index, $value);
        $this->map[$index] = $this->callingFile();
    }

    public function keyToFileMap(): array
    {
        return $this->map;
    }

    private function callingFile(): ?string
    {
        return debug_backtrace()[1]['file'] ?? null;
    }
}
