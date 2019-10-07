<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Inviqa\SprykerDebug\Tests\Support\Workspace\Workspace;
use PHPUnit\Framework\Assert;
use Twig\Environment;

class TwigContext implements Context
{
    /**
     * @var Workspace
     */
    private $workspace;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $rendered;

    public function __construct(Workspace $workspace, Environment $twig)
    {
        $this->workspace = $workspace;
        $this->twig = $twig;
    }

    /**
     * @Given I have the Twig template :name:
     */
    public function iHaveTheTwigTemplate(string $name, PyStringNode $string)
    {
        $this->workspace->put($name, $string->__toString());
    }

    /**
     * @When I render the :name template with the following parameters:
     */
    public function iRenderTheTemplateWithTheFollowingParameters(string $name, TableNode $table)
    {
        $this->rendered = $this->twig->render($name, $table->getRowsHash());
    }

    /**
     * @Then I should see the rendered template:
     */
    public function iShouldSeeTheRenderedTemplate(PyStringNode $string)
    {
        Assert::assertStringContainsString($string->__toString(), $this->rendered);
    }
}
