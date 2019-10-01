@db-transaction
Feature: Product Debug Command

  Background:
    Given the product "SKU-1234" exists as:
      | sku    | sku-1234    |
      | title  | Foo Product |
      | price  | 1234.12     |
      | stock  | 1234        |
      | url    | /foo/bar    |

  Scenario: Run command without specifying reports
    Given I enabled the "DebugReportPlugin"
    When I execute "debug:product SKU-1234 debug"
    Then I should see the following:
    """
    No reports specified, specify one or more of the following report names (comma separated):

    - debug
    """

  Scenario: Run command and specify report
    Given I enabled the "Inviqa\Spryker\Debug\Zed\DebugReportPlugin"
    When I execute "debug:product SKU-1234"
    Then I should see the following:
    """
    Debug

    +-------+
    | hello |
    +-------+
    | world |
    +-------+
    """

  Scenario: Run command and specify multiple reports
    Given I enabled the "Inviqa\Spryker\Debug\Zed\DebugReportPlugin"
    When I execute "debug:product SKU-1234 debug,debug"
    Then I should see the following:
    """
    Debug

    +-------+
    | hello |
    +-------+
    | world |
    +-------+

    Debug

    +-------+
    | hello |
    +-------+
    | world |
    +-------+
    """
