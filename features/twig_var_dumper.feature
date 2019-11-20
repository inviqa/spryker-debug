Feature: Twig Var Dumper

  As a frontend developer
  In order to effectively inspect variables in templates
  I want have access to a good var dumper

  See config/Shared/twig.php to see how to enable debug mode.

  Scenario: Dump using the var dumper
     Given I have the Twig template "hello.twig":
     """
     Hello World
     {{ dump() }}
     """
     When I render the "@workspace/hello.twig" template with the following parameters:
     | name      | value                   |
     | hello     | thisvalueshouldbedumped |
     Then I should see the rendered template:
     """
     thisvalueshouldbedumped
     """
