@editor @editor_tiny @tiny_typography
Feature: Tiny Typography
  In order to lay out course content
  As a user
  I need font size, font family and line height controls in the TinyMCE editor

  @javascript
  Scenario: The three typography controls reach the editor toolbar
    Given I log in as "admin"
    And I open my profile in edit mode
    When I expand all toolbars for the "Description" TinyMCE editor
    Then "Font size" button should exist in the "Description" TinyMCE editor
    And "Font family" button should exist in the "Description" TinyMCE editor
    And "Line height" button should exist in the "Description" TinyMCE editor

  Scenario: The administrator can configure the three lists
    Given I log in as "admin"
    When I navigate to "Plugins > Text editors > TinyMCE editor > Tiny Typography" in site administration
    Then I should see "Font sizes"
    And I should see "Font families"
    And I should see "Line heights"
