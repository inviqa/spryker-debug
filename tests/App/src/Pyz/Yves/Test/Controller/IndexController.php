<?php

namespace Pyz\Yves\Test\Controller;

use Generated\Shared\Transfer\TestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Pyz\Client\Test\TestClient getClient()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $this->getClient()->helloWorld(new TestTransfer());
        return new Response('<html><body>Hello World</body></html>');
    }
}
