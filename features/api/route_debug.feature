Feature: Remote API to debug routes

  As a backend developer
  In order to determine if my routes are correctly configured
  I want to be able to see and filter list of them all

  NOTE: The Zed Console has no access to the Yves appliction,
        otherwise we wouldn't need this API.

  Scenario: List all routes
    When request "/spryker-debug/routes" from Yves
    Then the response should contain:
    """
    "path":"\/spryker-debug\/routes"
    """
