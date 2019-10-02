@db-transaction
Feature: Stock and Availability Report

  Scenario: Generate stock report

    - Should reports should generate a value object with a toArray() method?
    - or should they just return an array?

    Given the product "SKU-1234" exists as:
      | sku            | sku-1234    |
      | title          | Foo Product |
      | stock          | 1234        |
      | availability   | 1200        |
      | reserved       | 34          |
    When I generate the report "stock_availability" for SKU "sku-1234"
    Then the following report should be generated:
    """
    {
        "sku": "sku-1234"
        "stock": 1234,
        "reserved": 34,
        "availability": 1200
    }
    """
