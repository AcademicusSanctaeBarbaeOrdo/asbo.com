@homepage
Feature: ASBO homepage
    In order to access and see informations
    As a visitor
    I want to be able to see the homepage

    Scenario: Viewing the homepage at website root
      When I am on "/"
      Then I should see "Se Connecter"

