Feature: Inspect Propel Entity

  Scenario: Inspect entities
    Given a test entity exists with name "foobar"
    When I execute console command "debug:propel:entity PyzTestEntity"
    Then the command should succeed
    And I should see the following output:
    """
    foobar
    """

  Scenario: Inspect entities by criteria
    Given a test entity exists with name "foobar"
    And a test entity exists with name "barfoo"
    When I execute console command "debug:propel:entity PyzTestEntity --by=Name:foobar"
    Then the command should succeed
    And I should see the following output:
    """
    foobar
    """
    And I should not see the following output:
    """
    barfoo
    """

  Scenario: Inspect entities by multiple criteria
    Given a test entity exists with name "foobar"
    And a test entity exists with name "barfoo"
    When I execute console command "debug:propel:entity PyzTestEntity --by=Name:foobar --by=idTestEntity:999"
    Then the command should succeed
    And I should not see the following output:
    """
    foobar
    """
    And I should not see the following output:
    """
    barfoo
    """

  Scenario: Limit number of entities
    Given a test entity exists with name "foobar"
    And a test entity exists with name "barfoo"
    When I execute console command "debug:propel:entity PyzTestEntity --limit=1"
    Then the command should succeed
    And I should see the following output:
    """
    1 entities
    """

  Scenario: Format as records
    Given a test entity exists with name "foobar"
    When I execute console command "debug:propel:entity PyzTestEntity --records"
    Then the command should succeed

  Scenario: Specify fields
    Given a test entity exists with name "foobar"
    When I execute console command "debug:propel:entity PyzTestEntity --fields=name"
    Then the command should succeed
    And I should see the following output:
    """
    foobar
    """
