<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Guzzle;

use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestProfile;

class RequestCollection
{
    private $profiles = [];

    public function register(RequestProfile $profile): void
    {
        $this->profiles[] = $profile;
    }

    public function toArray()
    {
        return [];
    }
}
