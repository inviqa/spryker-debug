@db-delete-inserted
Feature: Entity inspection

  As a developer
  In order to have confidence in the system
  I want to be to quickly obtain an authoritative overview of a given entity

  Background:

    Given the entity "Orm\Zed\Product\Persistence\SpyProductAbstract" exists as "product_abstract_1":
      | IdProductAbstract            | 1                       |
      | Sku                          | "TEST-1"                |
      | Attributes                   | "{}"                    |
    And the entity "Orm\Zed\Product\Persistence\SpyProduct" exists as "product_1":
      | IdProduct                    | 1                     |
      | Sku                          | "TEST-1-1"            |
      | Attributes                   | "{}"                  |
      | FkProductAbstract            | <product_abstract_1>  |

  Scenario: Inspect an entity with no reports

    When I execute console command "debug:entity 'Orm\Zed\Product\Persistence\SpyProductAbstract' 1"
    Then the command should succeed
    And I should see the following output:
    """
    No reports
    """

  Scenario: Error when no entities found

    When I execute console command "debug:entity 'Orm\Zed\Product\Persistence\SpyProductAbstract' 666"
    Then the command should exit with code "255"
    And I should see the following output:
    """
    Could not find any entities
    """

  Scenario: Error when some entities not found

    When I execute console command "debug:entity 'Orm\Zed\Product\Persistence\SpyProductAbstract' 1 666"
    Then the command should exit with code "255"
    And I should see the following output:
    """
    Could not find ids
    """

  Scenario: Render product report
    Given the file "entity_report_plugins.php" exists in the workspace:
    """
    <?php return [
      Inviqa\Zed\SprykerDebug\Communication\Plugin\ProductEntityReportPlugin::class,
    ];
    """
    When I execute console command "debug:entity 'Orm\Zed\Product\Persistence\SpyProduct' 1"
    Then the command should succeed
    And I should see the following output:
    """
    TEST-1-1
    """
