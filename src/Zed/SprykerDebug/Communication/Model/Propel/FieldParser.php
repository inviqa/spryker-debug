<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Propel;

final class FieldParser
{
    public function parse(string $fields): array
    {
        $fields = trim($fields);

        if (empty($fields)) {
            return [];
        }

        return array_map('trim', explode(',', $fields));
    }
}
