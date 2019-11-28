<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Propel;

final class CriteriaParser
{
    public function parseMany(array $criterias): array
    {
        return array_reduce($criterias, function (array $carry, string $criteria) {
            return array_merge($carry, $this->parse($criteria));
        }, []);
    }

    public function parse(string $criteria): array
    {
        $colonPos = strpos($criteria, ':');

        if (!$criteria) {
            return [];
        }

        if ($colonPos === false) {
            return [
                $criteria => null,
            ];
        }

        return [
            substr($criteria, 0, $colonPos) => substr($criteria, $colonPos + 1),
        ];
    }
}
