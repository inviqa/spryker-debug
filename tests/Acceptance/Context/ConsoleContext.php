<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Inviqa\SprykerDebug\Tests\Support\Workspace\Workspace;
use PHPUnit\Framework\Assert;
use Symfony\Component\Process\Process;

class ConsoleContext implements Context
{
    /**
     * @var Workspace
     */
    private $workspace;

    private $process;

    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;
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
        $this->process = new Process(
            sprintf(__DIR__ . '/../../App/bin/console %s', $command),
            $this->workspace->path()
        );
        $this->process->run();
    }

    /**
     * @Then the command should succeed
     * @Then the command should exit with code :exitCode
     */
    public function theCommandShouldExitWithCode(int $exitCode = 0)
    {
        if ($this->process->getExitCode() == $exitCode) {
            return;
        }

        Assert::fail(sprintf(
            'Command exited with "%s" but expected "%s": STDOUT: %s STDERR: %s',
            $this->process->getExitCode(),
            $exitCode,
            $this->process->getOutput(),
            $this->process->getErrorOutput()
        ));
    }

    /**
     * @Then I should see the following output:
     */
    public function iShouldSeeTheFollowingOutput(PyStringNode $string)
    {
        Assert::assertContains($string->getRaw(), $this->process->getOutput());
    }

    /**
     * @Then I should not see the following output:
     */
    public function iShouldNotSeeTheFollowingOutput(PyStringNode $string)
    {
        Assert::assertNotContains($string->getRaw(), $this->process->getOutput());
    }

    /**
     *
     * @Then the command should fail
     */
    public function theCommandShouldFail()
    {
        Assert::assertNotEquals(0, $this->process->getExitCode());
    }
}
