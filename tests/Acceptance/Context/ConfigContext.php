<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use function Safe\json_decode;

class ConfigContext implements Context
{
    /**
     * @BeforeScenario
     * @BeforeSuite
     */
    public static function removeLocalConfig()
    {
        if (!file_exists(self::configLocalPath())) {
            return;
        }

        unlink(self::configLocalPath());
    }

    /**
     * @Given I have the following local configuration:
     */
    public function setTheFollowingConfiguration(TableNode $table)
    {
        $file = [
            '<?php',
        ];

        foreach ($table->getRowsHash() as $name => $value) {
            $file[] = sprintf(
                '$config[\'%s\'] = %s;',
                $name,
                var_export(json_decode($value, true), true)
            );
        }

        file_put_contents(
            self::configLocalPath(),
            implode(PHP_EOL, $file)
        );
    }

    private static function configLocalPath(): string
    {
        return __DIR__ . '/../../App/config/Shared/config_local.php';
    }
}
