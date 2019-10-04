<?php

namespace Inviqa\SprykerDebug\Zed\Communication\Model\Config;

use ArrayObject;

class KeyTrackingArrayObject extends ArrayObject
{
    private $map = [];

    public function offsetSet($index, $newVal)
    {
        parent::offsetSet($index, $newVal);
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
