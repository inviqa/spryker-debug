<?php

namespace Inviqa\Zed\SprykerDebug\Business\Model\Inspector;

interface Report
{
    public function accepts(object $entity): bool;

    public function render(object $entity): string;
}
