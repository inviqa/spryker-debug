Feature: Peek at messages in a queue

  As a developer
  In order to check the information in a queue
  I want a command which will:
    - pick a message from the queue
    - show it to me
    - requeue it

  Scenario: Peek at message in a queue

    Given the queue "foobar" exists
    And I add the following message to queue "foobar":
    """
    {"hello":"goodbye"}
    """

    When I execute console command "debug:queues:peek foobar"

    Then the command should succeed
    And I should see the following output:
    """
    {"hello":"goodbye"}
    """

  Scenario: Pretty print JSON output

    Given the queue "foobar" exists
    And I add the following message to queue "foobar":
    """
    {"hello":"goodbye"}
    """

    When I execute console command "debug:queues:peek foobar --json"

    Then the command should succeed
    And I should see the following output:
    """
    {
      "hello":"goodbye"
    }
    """

  Scenario: Pick multiple messages

    Given the queue "foobar" exists
    And I add the following message to queue "foobar":
    """
    {"hello":"goodbye"}
    """
    And I add the following message to queue "foobar":
    """
    {"foo":"bar"}
    """

    When I execute console command "debug:queues:peek foobar --count=2"

    Then the command should succeed
    And I should see the following output:
    """
    {"hello":"goodbye"}
    {"foo":"bar"}
    """

