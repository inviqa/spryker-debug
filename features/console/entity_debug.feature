@db-transaction
Feature: Entity inspection

  As a developer
  In order to have confidence in the system
  I want to be to quickly obtain an authoritative overview of a given entity

  Scenario: Inspect an entity

    Given the entity "Orm\Zed\Product\Persistence\SpyProductAbstract" exists as "product_abstract_1":
      | IdProductAbstract            | 1                       |
      | Sku                          | "TEST-1"                |
      | Attributes                   | "{}"                    |
    And the entity "Orm\Zed\Product\Persistence\SpyProduct" exists as "product_1":
      | IdProduct                    | 1                     |
      | Sku                          | "TEST-1-1"            |
      | Attributes                   | "{}"                  |
      | FkProductAbstract            | <product_abstract_1>  |

    When I execute console command "debug:entity 'Orm\Zed\Product\Persistence\SpyProductAbstract' 1"
    Then the command should succeed
