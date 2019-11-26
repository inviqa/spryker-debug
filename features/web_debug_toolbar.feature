Feature: Web Debug Toolbar

  As a backend developer
  When developing an application
  In order to debug the most recent web request
  I want the web debug toolbar to be shown

  Scenario: Web Profiler is shown
    When request "/zed" from Yves
    Then the response should contain:
    """
    sf-toolbar
    """
