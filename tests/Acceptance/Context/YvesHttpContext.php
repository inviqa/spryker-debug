<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use GuzzleHttp\Client;
use PHPUnit\Framework\Assert;

class YvesHttpContext implements Context
{
    /**
     * @var Client
     */
    private $yvesClient;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(Client $yvesClient)
    {
        $this->yvesClient = $yvesClient;
    }

    /**
     * @When request :url from Yves
     */
    public function requestFromYves(string $url)
    {
        $this->response = $this->yvesClient->get($url);
    }

    /**
     * @Then the response should have HTTP status code :code:
     */
    public function theResponseShouldHaveStatusCode(int $code)
    {
        Assert::assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Then the response should contain:
     */
    public function theResponseShouldContain(PyStringNode $string)
    {
        Assert::assertStringContainsString($string->__toString(), $this->response->getBody()->__toString());
    }
}
