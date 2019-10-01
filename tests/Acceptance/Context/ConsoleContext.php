<?php

namespace Inviqa\Spryker\Debug\Tests\Acceptance\Context;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class ConsoleContext implements Context
{
    /**
     * @var ProductFacadeInterface
     */
    private $productFacade;

    public function __construct(ProductFacadeInterface $productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @Given the product :arg1 exists as:
     */
    public function theProductExistsAs(string $sku, TableNode $table)
    {
        $productTransfer = new ProductConcreteTransfer();
        $this->productFacade->saveProductConcrete($productTransfer);
    }

    /**
     * @Given I enabled the :arg1
     */
    public function iEnabledThe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I execute :arg1
     */
    public function iExecute($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the following:
     */
    public function iShouldSeeTheFollowing(PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Given the product SKU-:arg1 exists as:
     */
    public function theProductSkuExistsAs($arg1, TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When I generate the report :arg1 for SKU :arg2
     */
    public function iGenerateTheReportForSku($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the following report should be generated:
     */
    public function theFollowingReportShouldBeGenerated(PyStringNode $string)
    {
        throw new PendingException();
    }
}
