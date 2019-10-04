<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Inviqa\SprykerDebug\Tests\Support\Workspace\Workspace;

class WorkspaceContext implements Context
{
    /**
     * @var Workspace
     */
    private $workspace;

    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;
    }

    /**
     * @BeforeScenario
     */
    public function reset()
    {
        $this->workspace->reset();
    }

    /**
     * @Given the file :name exists in the workspace:
     */
    public function theFileExistsInTheWorkspace($name, PyStringNode $string)
    {
        $this->workspace->put($name, $string->getRaw());
    }

    /**
     * @Given the file :name has permissions :permissions:
     */
    public function theFileHasPermissions($name, string $permissions)
    {
        chmod($this->workspace->path($name), octdec($permissions));
    }
}
