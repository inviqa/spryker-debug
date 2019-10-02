<?php

namespace InviqaSprykerDebug\Tests\Acceptance\Context;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use InviqaSprykerDebug\Shared\Workspace\Workspace;
use InviqaSprykerDebug\Zed\Behat\State\ProcessState;
use PHPUnit\Framework\Assert;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class ConsoleContext implements Context
{
    /**
     * @var ProductFacadeInterface
     */
    private $productFacade;

    /**
     * @var Workspace
     */
    private $workspace;

    /**
     * @var ProcessState
     */
    private $processState;

    public function __construct(ProductFacadeInterface $productFacade, Workspace $workspace, ProcessState $processState)
    {
        $this->productFacade = $productFacade;
        $this->workspace = $workspace;
        $this->processState = $processState;
    }

    /**
     * @Given the product :arg1 exists as:
     */
    public function theProductExistsAs(string $sku, TableNode $table)
    {
        $productTransfer = new ProductAbstractTransfer();
        $productTransfer->setSku($sku);
        $idProductAbstract = $this->productFacade->createProductAbstract($productTransfer);

        $productTransfer = new ProductConcreteTransfer();
        $productTransfer->setFkProductAbstract($idProductAbstract);
        $productTransfer->setSku($sku);
        $this->productFacade->createProductConcrete($productTransfer);
    }

    /**
     * @Given I enabled the :arg1
     */
    public function iEnabledThe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I execute console command :command
     */
    public function iExecute($command)
    {
        $process = $this->processState->create(
            sprintf(__DIR__ . '/../../App/bin/console %s', $command),
            $this->workspace->path()
        );
        $process->run();
    }

    /**
     * @Then the command should succeed
     * @Then the command should exit with code :exitCode
     */
    public function theCommandShouldExitWithCode(int $exitCode = 0)
    {
        $process = $this->processState->getLastProcess();
        if ($process->getExitCode() == $exitCode) {
            return;
        }

        Assert::fail(sprintf(
            'Command exited with "%s" but expected "%s": STDOUT: %s STDERR: %s',
            $process->getExitCode(),
            $exitCode,
            $process->getOutput(),
            $process->getErrorOutput()
        ));
    }

    /**
     * @Then I should see the following output:
     */
    public function iShouldSeeTheFollowingOutput(PyStringNode $string)
    {
        $process = $this->processState->getLastProcess();
        Assert::assertContains($string->getRaw(), $process->getOutput());
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
