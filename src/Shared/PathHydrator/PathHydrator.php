<?php

namespace InviqaSprykerDebug\Shared\PathHydrator;

use Symfony\Component\PropertyAccess\PropertyAccessor;

final class PathHydrator
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    public function __construct(PropertyAccessor $accessor)
    {
        $this->accessor = $accessor;
    }

    public static function create(): self
    {
        return new self(new PropertyAccessor(false, true));
    }

    public function hydrate($object, array $data): void
    {
        foreach ($data as $path => $value) {
            $this->accessor->setValue($object, $path, $value);
        }
    }

    public function hydrateFromJsonValues($object, array $data): void
    {
        $this->hydrate($object, array_map(function ($value) {
            return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        }, $data));
    }
}
