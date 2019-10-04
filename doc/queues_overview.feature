@queue-purge
Feature: Queues Overview

  As a developer
  In order to diagnose a syncronization issue
  I want to be able to quickly check the state of the queues

  Scenario: Show queue status
    Given I add the following messages to queue "foobar"
    """
    {"message": "yes"}
    """
    When I run
