Feature: Config Dump

  As a developer
  In order to quickly verify correct configuration of a Spryker project
  I want to be able to introspect the configuration

  Scenario: List all configuration
    Given I have the following local configuration:
      | TEST_KEY_1 | Hello |
      | TEST_KEY_2 | World |
    When I execute console command "debug:config"
    Then the command should succeed
    And I should see the following output:
    """
    TEST_KEY_1
    """

  Scenario: Filter configuration
    Given I have the following local configuration:
      | TEST_KEY_1 | Hello |
      | TEST_KEY_2 | World |
    When I execute console command "debug:config KEY_1"
    Then the command should succeed
    And I should see the following output:
    """
    TEST_KEY_1
    """
    And I should not see the following output:
    """
    TEST_KEY_2
    """
