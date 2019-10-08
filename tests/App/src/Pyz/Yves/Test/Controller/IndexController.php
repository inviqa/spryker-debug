<?php

namespace Pyz\Yves\Test\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        return new Response('Hello World');
    }
}
