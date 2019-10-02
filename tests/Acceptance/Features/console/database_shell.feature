Feature: Open a new database shell

  As a developer
  In order to quickly inspect the database for a Spryker application
  I want to run a command which opens the database shell


  Scenario:
    Given the file "test-shell" exists in the workspace:
    """
    #!/bin/bash
    echo "Hello World"
    """
    And the file "test-shell" has permissions "0777":
    When I execute console command "inviqa:database:shell --shell=./test-shell"
    Then the command should succeed
