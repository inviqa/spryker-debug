Feature: Debug Propel Metadata

  As a developer
  I want to easily inspect propel metadata
  Because I can

  Scenario: Inspect metadata by table name
    When I execute console command "debug:propel:metadata spy_store"

    Then the command should succeed
    And I should see the following output:
    """
    SpyStore
    """

  Scenario: Inspect metadata by PHP name
    When I execute console command "debug:propel:metadata SpyStore"

    Then the command should succeed
    And I should see the following output:
    """
    SpyStore
    """

  Scenario: List all table names
    When I execute console command "debug:propel:metadata --no-interaction"
    Then the command should succeed
