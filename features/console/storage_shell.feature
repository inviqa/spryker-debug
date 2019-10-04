Feature: Open a new Redis shell

  As a developer
  In order to quickly inspect the Redis storage for a Spryker application
  I want to run a command which opens the database shell

  Background:
    Given the file "test-shell" exists in the workspace:
    """
    #!/bin/bash
    echo "Hello World"
    """
    And the file "test-shell" has permissions "0777":

  Scenario: Execute Redis shell

    Note that we cannot actually execute a Redis shell here, so we specify the shell
    as a bash script.

    By default the command will try and open the `redis-cli` shell and allow you to
    interact with the database.

    When I execute console command "debug:redis:shell --shell=./test-shell"
    Then the command should succeed
