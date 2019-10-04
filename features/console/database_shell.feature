Feature: Open a new database shell

  As a developer
  In order to quickly inspect the database for a Spryker application
  I want to run a command which opens the database shell


  Scenario: Execute database shell

    Note that we cannot actually execute a database shell here, so we specify the shell
    as a bash script.

    By default the command will try and open the `psql` shell and allow you to
    interact with the database.

    Given the file "test-shell" exists in the workspace:
    """
    #!/bin/bash
    echo "Hello World"
    """
    And the file "test-shell" has permissions "0777":
    When I execute console command "debug:database:shell --shell=./test-shell"
    Then the command should succeed
