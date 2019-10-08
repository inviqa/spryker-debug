Feature: Route debug

  As a developer
  In order to visualize and customize my routes
  I want to be able to execute a command list detailed information for my routes

  Scenario: List all routes

    When I execute console command "debug:routes"
    Then the command should succeed
    And I should see the following output:
    """
    ====================== ======== ======== ====== =======================
     Name                  Method   Scheme   Host   Path
    ====================== ======== ======== ====== =======================
     home                  ANY      ANY      ANY    /
     spryker-debug-routes  ANY      ANY      ANY    /spryker-debug/routes
    ====================== ======== ======== ====== =======================
    """

  Scenario: Show defaults (including the controller)

    When I execute console command "debug:routes --defaults"
    Then the command should succeed
    And I should see the following output:
    """
    controller.service.spryker-debug
    """

  Scenario: Show requirements

    When I execute console command "debug:routes --requirements"
    Then the command should succeed
    And I should see the following output:
    """
    Requirements
    """

  Scenario: Show condition

    When I execute console command "debug:routes --condition"
    Then the command should succeed
    And I should see the following output:
    """
    Condition
    """
